<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDOException;

class UserController extends Controller
{
    //user userAll
    public function userAll()
    {
        $data = array();
        $data['active_menu'] = 'user';
        $data['page_title'] = 'User List';
        $user = User::all();
        return view('backend.user.user_list', compact('data', 'user'));
    }
    //userEdit
    public function userDelete($id)
    {
        User::find($id)->delete();
        return to_route('user_all')->with('message', 'User Deleted Successfully !!!');
    }
    //userApprove
    public function userApprove()
    {
        $data = array();
        $data['active_menu'] = 'user';
        $data['page_title'] = 'User Approve List';
        $user = User::where('status', 'pending')->get();
        return view('backend.user.user_approve_list', compact('data', 'user'));
    }
    //userApproveDetails
    public function userApproveDetails($id)
    {
        $user = User::find($id);
        $user->status = 'approved';
        $user->save();
        return back()->with('message','User Approved Successfully');

    }
    public function user_create()
    {
        $data = array();
        $data['active_menu'] = 'user';
        $data['page_title'] = 'User Create';
        return view('backend.user.userCreate',compact('data'))->with('message','User Approved Successfully');
    }
    //addUser
    public function addUser(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email', // Add unique validation rule for email
        'image' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
    ]);

    if (request()->hasFile('image')) {
        $extension = request()->file('image')->extension();
        $photo_name = "backend/img/user/" . uniqid() . '.' . $extension;
        request()->file('image')->move('backend/img/user/', $photo_name);
    } else {
        $photo_name = null;
    }

    // Create the user without duplicating the code
    $user = User::create([
        'name' => request('name'),
        'email_verified' => 'yes',
        'email' => request('email'),
        'image' => $photo_name,
        'address' => request('address'),
        'specialist' => request('specialist'),
        'working_place' => request('working_place'),
        'phone' => request('phone'),
        'password' => bcrypt(request('password')),
        'confirm_password' => bcrypt(request('confirm_password')),
    ]);

    return redirect()->back()->with('success', 'User Created Successfully');
}

    //userDisable
    public function userDisable(Request $request,$id){
       $user = User::find($id);
       $user->user_status = 'userEnable';
       $user->save();
       return redirect()->back()->with('success', 'Users Updated Successfully');
    }
    //userEnable
    public function userEnable(Request $request,$id){
        $user = User::find($id);
        $user->user_status = 'userDisable';
        $user->save();
        return redirect()->back()->with('success', 'Users Updated Successfully');
     }
     //userEdit
     public function userEdit($id){
        $data = array();
        $data['active_menu'] = 'user';
        $data['page_title'] = 'Event Edit';
        $user = User::find($id);
        if(request()->isMethod('post')){
            try{
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= 'backend/img/user/'.uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/user', $photo_name);
               }else{
                   $photo_name = null;
               }
               if(request()->hasFile('image'))
               {
                $user->update([
                    'name'=> request('name'),
                    'email'=>request('email'),
                    'image'=>$photo_name,
                'email_verified'=> 'yes',
                    'address'=>request('address'),
                    'specialist'=>request('specialist'),
                    'working_place'=>request('working_place'),
                    'phone'=>request('phone'),
                    'password'=>bcrypt(request('password')),
                    'confirm_password'=>bcrypt(request('confirm_password'))
                  ]);
               }
               $user->update([
                'name'=> request('name'),
                'email'=>request('email'),
                // 'image'=>$photo_name,
                'email_verified'=> 'yes',
                'address'=>request('address'),
                'specialist'=>request('specialist'),
                'working_place'=>request('working_place'),
                'phone'=>request('phone'),
                'password'=>bcrypt(request('password')),
                'confirm_password'=>bcrypt(request('confirm_password'))
              ]);
              return to_route('user_all')->with('success', 'User Updated Successfully');
            }catch(PDOException $e){
               return redirect()->back()->with('error', 'Failed Please Try Again');
            }
           }
        return view('backend.user.userEdit',compact('user','data'));
     }
}
