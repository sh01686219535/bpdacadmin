<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use PDOException;
use App\Image;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class EventController extends Controller
{
    public function event()
    {
        $data = array();
        $data['active_menu'] = 'Event';
        $data['page_title'] = 'Event List';
        $event = Event::all();

        return view('backend.event.eventList',compact('event','data'));
    }
    public function eventCreate()
    {

        $data = array();
        $data['active_menu'] = 'Event';
        $data['page_title'] = 'Event Create';
        $event = Event::select('status')->get();
        if(request()->isMethod('post')){
            try{
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/events/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/events', $photo_name);
               }else{
                   $photo_name = null;
               }

               Event::create([
                   'title' => request('title'),
                   'image' => $photo_name,
                   'description' => request('description'),
                   'cost' => request('cost'),
                   'start_date' => request('start_date'),
                //    'end_date' => request('end_date'),
                   'status' => request('status'),
                   'venue' => request('venue'),
              ]);
              return redirect()->back()->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
        return view('backend.event.eventCreate',compact('data','event'));

    }
    //event_user
    public function event_user()
    {
        $data = array();
        $data['active_menu'] = 'Event';
        $data['page_title'] = 'Event User';
        $userEvent = UserEvent::all();

        return view('backend.event.event_user',compact('data','userEvent'));
    }
    //event_delete
    public function event_delete($id)
    {
        Event::find($id)->delete();
        return back()->with('success', 'Event Removed Successfully');
    }
    //eventEdit
    public function eventEdit(Request $request,$id){
        $data = array();
        $data['active_menu'] = 'Event_User';
        $data['page_title'] = 'Event Edit';
        $event = Event::find($id);
        if(request()->isMethod('post')){
            try{

                $images = [];
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/events/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/events', $photo_name);
               }else{
                // request()->image =  (new Image)->dirName('package')->file('image')
                // ->resizeImage(500, 500)
                // ->save();
               }
               if ($files = request()->file('memories')) {

                foreach ($files as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $photoName = "backend/img/events/" . uniqid() . '.' . $extension;
                    $file->move('backend/img/events', $photoName);

                    // Save image name to the array
                    $images[] = $photoName;
                }
            }


        $event->title = $request->title;
        if (request()->hasFile('image')) {
            $event->image = $photo_name;
        }
        if (request()->file('memories')) {
            $event->memories = json_encode($images);
        }
        $event->description = $request->description;
        $event->cost = $request->cost;
        $event->start_date = $request->start_date;
        $event->status = $request->status;
        $event->video_link = $request->video_link;
        $event->venue = $request->venue;
        $event->save();

              return redirect()->back()->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
           return view('backend.event.eventEdit',compact('event','data'));
    }
    //userEventList
    public function userEventList(){
        $data = array();
        $data['active_menu'] = 'Event_User';
        $data['page_title'] = 'Event Edit';
        $userEvent = UserEvent::all();
        $event = Event::all();
        return view('backend.event.eventUserList',compact('data','userEvent','event'));
    }
    //userEventDelete
    public function userEventDelete($id){
        $userEvent = UserEvent::find($id);
        $userEvent->delete();
        return back()->with('success', 'Event Deleted Successfully');
    }
}
