<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\SendMailreset;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Mail\UserVerification;
use App\Models\Contact;
use App\Models\Event;
use App\Models\OurTeam;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{

    public function eventRegister()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user) {
            try {
                $event = UserEvent::create([
                    'user_id' => request('user_id'),
                    'event_id' => request('event_id'),
                    'adult' => request('adult'),
                    'midAge' => request('midAge'),
                    'child' => request('child'),
                    'transport' => request('transport'),
                    'total_Amount' => request('total_Amount'),
                ]);
                return response()->json($event, 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
    }
    //getEventRegister
    public function getEventRegister()
    {
        $userEvent = UserEvent::get();
        return response()->json($userEvent,200);
    }
    //userRegister
    public function userRegister()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'confirm_password' => 'required|same:password',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])[A-Za-z\d@$!%*?&]+$/',
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        if (request()->hasFile('image')) {
            $extension = request()->file('image')->extension();
            $photo_name = "backend/img/user/" . uniqid() . '.' . $extension;
            request()->file('image')->move('backend/img/user/', $photo_name);
        }
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            // 'phone' => request('phone'),
            // 'address' => request('address'),
            // 'specialist'=>request('specialist'),
            // 'working_place'=>request('working_place'),
            // 'image' => $photo_name,
            'password' => bcrypt(request('password')),
            'confirm_password' => bcrypt(request('confirm_password')),
        ]);
        $code = sha1(rand(1000, 8000));
        $user->UserVerify()->create([
            'code' => $code
        ]);
        $generatedUrl = route('user.verify', [$user->email, $code]);
        Mail::to($user->email)->send(new UserVerification($generatedUrl));
        return response()->json([
            'status' => 'ok',
            'message' => 'User CReated'
        ]);
    }
    //email verify
    //user email verify
    public function verify($email, $code)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($user->email_verified == 'no') {
                $userCode = $user->UserVerify->code;
                if ($userCode == $code) {
                    $user->update([
                        'email_verified' => 'yes'
                    ]);

                    $user->UserVerify->delete();
                    //email to admin

                    try{
                        $data = ['name' => 'Admin', 'email' => 'shahediqbal80@gmail.com'];
                        Mail::send('backend.sendMail', $data, function ($message) use ($data)
                        {
                            $message->from('info@bpdac.ca','Admin');
                            $message->to($data['email'], $data['name'])
                                ->subject('Approval of Order');
                        });
                    }catch (\Exception $e) {
                        // Log or dump the exception message for debugging
                        dd($e->getMessage());
                    }

                                        // end email to admin
                    return '<strong style="font-size: xx-large;">Congratulations! Your email has been successfully verified.<br> <a href="https://bpdac.ca/login">https://bpdac.ca/login</a></strong>';

                } else {
                    return '<strong style="font-size: xx-large;">Unauthorized Data!!!</strong>';
                }
            }else{
                return '<strong style="font-size: xx-large;"> Your email has already been verified</strong>';
            }
        } else {
            return '<strong style="font-size: xx-large;">Unauthorized</strong>';
        }
    }
    //userLogin
    public function userLogin()
    {
        $credentials = request()->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();

        if ($user) {
            if ($user->status === 'pending') {
                return response()->json(['error' => 'User is pending approval.'], 403);
            }

            $userData = User::select('id', 'name', 'phone','email_verified', 'email', 'address')->find($user->id);


            if ($userData) {

                $cookie = cookie('jwt', $token, 60 * 24);
                return response()->json([
                    'status' => 'ok',
                    'token' => $token,
                    'user' => $userData,

                ])->withCookie($cookie);
            } else {
                return response()->json(['error' => 'User not found or has missing columns.'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
    }
    public function eventData()
    {
        $event = Event::all();
        return response()->json($event, 200);
    }
    public function userData()
    {
        $event = User::select('id', 'name', 'email', 'image', 'phone', 'address', 'status', 'email_verified','specialist','working_place', 'user_status')->where('user_status', 'userEnable')->get();
        return response()->json($event, 200);
    }
    //event_user_counts
    public function event_user_counts()
    {
        $userEvent = UserEvent::select(
            'event_id',
            'user_id',
            \DB::raw('SUM(adult) as adult_sum'),
            \DB::raw('SUM(midAge) as midAge_sum'),
            \DB::raw('SUM(child) as child_sum'),
            \DB::raw('SUM(adult + midAge + child) as total_person')
        )
        ->groupBy('event_id', 'user_id')
        ->get();

     return response()->json($userEvent);
    }
    //profileProgress
    public function profileProgress()
    {
        try {
            $user = JWTAuth::user();
            $profileCompletion = $this->calculateProfileCompletion($user);
            return response()->json([
                'userProfileBar' => $profileCompletion,
            ], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    private function calculateProfileCompletion($user)
    {
        $profileFields = ['name', 'email', 'phone','password','confirm_password','address','image','specialist','working_place'];
        $completedFields = 0;

        foreach ($profileFields as $field) {
            if (!empty($user->$field)) {
                $completedFields++;
            }
        }
        // Calculate the percentage
        $profileCompletionPercentage = ($completedFields / count($profileFields)) * 100;

        return round($profileCompletionPercentage, 2);
    }
    public function contact()
    {
        $contact = Contact::create([
            'name' => request('name'),
            'email' => request('email'),
            'subject' => request('subject'),
            'description' => request('description'),
        ]);
        return response()->json($contact, 200);
    }
    public function ourTeam(){
        $ourTeam = OurTeam::all();
        return response()->json($ourTeam, 200);
    }
    public function userUpdate()
    {

        $user = JWTAuth::user();
        if ($user) {
            $userData = User::select('id', 'name')->find($user->id);
            if(request()->hasFile('image')){
                $extension = request()->file('image')->extension();
                $photo_name= "backend/img/user/".uniqid().'.'.$extension;
                request()->file('image')->move('backend/img/user', $photo_name);
                $user->update([
                    'image' => $photo_name,
                ]);
            }else{
                $photo_name = null;
            }
            $user->update([
                'name' => request('name'),
                // 'email' => request('email'),
                'phone' => request('phone'),
                'specialist' => request('specialist'),
                'working_place' => request('working_place'),
                'address' => request('address'),

            ]);
            return response()->json([
                'status' => 'ok',
                'message' => 'Profile Updated',
                'userUpdated'=> $userData

            ],200);
        } else {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
    }
    //Questionnaire
    public function Questionnaire(Request $request){
        $Questionnaire = new Questionnaire();
        $Questionnaire->user_id  = $request->user_id ;
        $Questionnaire->newcomer = $request->newcomer;
        $Questionnaire->enrolledInResidency = $request->enrolledInResidency;
        $Questionnaire->practiceReadyPathway = $request->practiceReadyPathway;
        $Questionnaire->completedLicensingExams = $request->completedLicensingExams;
        $Questionnaire->Bangladeshi_medical = $request->Bangladeshi_medical;
        $Questionnaire->medical_college = $request->medical_college;
        $Questionnaire->year_of_graduation = $request->year_of_graduation;
        $Questionnaire->allied_health = $request->allied_health;
        $Questionnaire->practice_ph_dn = $request->practice_ph_dn;
        $Questionnaire->specify_industry = $request->specify_industry;
        $Questionnaire->save();
        return response()->json($Questionnaire);
    }
    public function getQuestionnaire()
    {
        $question = Questionnaire::get();
        return response()->json($question);
    }
    // userEvent
    public function userEvent()
    {
        $userEvent = UserEvent::select('user_id','event_id')->get();
        return response()->json($userEvent);
    }
    //reset password
    public function sendEmail(Request $request)  // this is most important function to send mail and inside of that there are another function
    {
        if (!$this->validateEmail($request->email)) {  // this is validate to fail send mail or true
            return $this->failedResponse();
        }
        $this->send($request->email);  //this is a function to send mail
        return $this->successResponse();
    }
    public function send($email)  //this is a function to send mail
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailreset($token, $email));  // token is important in send mail
    }
    public function createToken($email)  // this is a function to get your request email that there are or not to send mail
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken) {
            return $oldToken->token;
        }

        $token = Str::random(40);
        $this->saveToken($token, $email);
        return $token;
    }
    public function saveToken($token, $email)  // this function save new password
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
    public function validateEmail($email)  //this is a function to get your email from database
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'error' => 'Email does\'t found on our database'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'Reset Email is send successfully, please check your inbox.'
        ], Response::HTTP_OK);
    }
    public function passwordResetProcess(UpdatePasswordRequest $request){
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
      }

      // Verify if token is valid
      private function updatePasswordRow($request){
         return DB::table('password_resets')->where([
             'email' => $request->email,
             'token' => $request->resetToken
         ]);
      }

      // Token not found response
      private function tokenNotFoundError() {
          return response()->json([
            'error' => 'Either your email or token is wrong.'
          ],Response::HTTP_UNPROCESSABLE_ENTITY);
      }

      // Reset password
      private function resetPassword($request) {
          // find email
          $userData = User::whereEmail($request->email)->first();
          // update password
          $userData->update([
            'password'=>bcrypt($request->password)
          ]);
          // remove verification data from db
          $this->updatePasswordRow($request)->delete();

          // reset password response
          return response()->json([
            'data'=>'Password has been updated.'
          ],200);
      }
}
