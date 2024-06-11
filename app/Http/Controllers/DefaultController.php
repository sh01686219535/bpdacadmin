<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //userGet
    public function userGet()
    {
        $event_id = request()->event_id;
        $event = UserEvent::where('event_id',$event_id)->where('status','false')->get();
        $html = '<option value="">Select An User</option>';
        foreach ($event as $events) {
            $html .= '<option value="'.$events->id.'">'.$events->user->name ?? '-'.'</option>';
        }
        return response()->json($html);
    }
    public function getAttendanceData($eventId)
    {
        $attendanceData = Attendance::where('event_id', $eventId)->with('user')->get();
        return response()->json($attendanceData);
    }
    public function getUserData(Request $request)
    {
    //     $eventSelect = $request->event;

    // // Fetch the package details based on ID
    // $attendance = Attendance::where('event_id', $eventSelect)->get();

    // // Return the package details as JSON
    // return response()->json($eventSelect);

        $eventSelect = $request->eventtt;


        // Fetch the attendance data based on the selected event
        $attendanceData = Attendance::where('event_id', $eventSelect)->get();

        // Return the attendance data as JSON
        return response()->json($eventSelect);
    }
    //getevent
    public function getevent(Request $request){
        $event_id = $request->input('event_id');
        $events = UserEvent::with('user', 'event')->where('event_id', $event_id)->get();
        $events = $events->map(function ($event) {
            $event->delete_route = route('user_event_delete', $event->id);
            return $event;
        });
        return response()->json($events);
    }
//getUserEvent
    public function getUserEvent(Request $request){
    $event_id = $request->event_id;
    $events = Attendance::where('event_id', $event_id)->get();
    $events = $events->map(function ($event) {
        $event->delete_route = route('user_event_delete', $event->id);
        return $event;
    });
    return response()->json($events);
}

}
