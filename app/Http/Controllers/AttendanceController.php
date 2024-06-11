<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PDOException;

class AttendanceController extends Controller
{
    public function showForm(Request $request)
    {
        $event = Event::all();
        $data = array();
        $data['active_menu'] = 'attendance';
        $data['page_title'] = 'attendance Form';
        if(request()->isMethod('post')){
            try{
              return redirect()->back()->with('success', 'Event Created Successfully');
            }catch(Exception $e){
               return  $e;
            }
           }
        return view('backend.attendance.attendance_add',compact('data','event'));
    }
    public function presentUser($id)
    {
        $user = User::find($id);
        $user_id = $user->id;
        Attendance::create([
            'user_id' => $user_id,
            'status' =>'present',
        ]);
        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }
    public function absentUser($id)
    {
        $user = User::find($id);
        $user_id = $user->id;
        Attendance::create([
            'user_id' => $user_id,
            'status' =>'absent',
        ]);
        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }
    //attendanceList
    public function attendanceList(){


        $attendance = Attendance::all();
        $event = Event::all();
        $data = array();
        $data['active_menu'] = 'attendance';
        $data['page_title'] = 'attendance List';
        return view('backend.attendance.attendance_list',compact('attendance','data','event'));
    }
    //storeAttendance
    public function storeAttendance(Request $request){
        $attendance = new Attendance();
        $attendance->user_id = $request->user_id;
        $attendance->event_id = $request->event_id;
        $attendance->status = 'present';
        $attendance->save();
        $userEvent = UserEvent::where('id',$request->user_id)->get();

        foreach ($userEvent as $value) {
            // dd($value->id);
            $value->update([
                'status' => 'true'
            ]);
        }
        return back()->with('success', 'Event Created Successfully');
    }

}
