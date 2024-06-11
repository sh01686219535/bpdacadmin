<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;
use PDOException;

class OurTeamController extends Controller
{
    public function ourTeam()
    {
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Create Our Team';
        if(request()->isMethod('post')){
            try{
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/ourTeam/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/ourTeam', $photo_name);
               }else{
                   $photo_name = null;
               }

               OurTeam::create([
                   'name' => request('name'),
                   'title' => request('title'),
                   'sub_designation' => request('sub_designation'),
                   'image' => $photo_name,
                   'designation' => request('designation'),
              ]);
              return redirect()->back()->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return redirect()->back()->with('error', 'Failed Please Try Again');
            }
           }
        return view('backend.ourTeam.ourTeamCreate',compact('data'));
    }
    public function ourTeamList()
    {
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Our Team List';
        $ourTeam = OurTeam::all();
        return view('backend.ourTeam.ourTeamList',compact('ourTeam','data'));
    }
    public function ourTeam_edit($id)
    {
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Edit Our Team';
        $ourTeam = OurTeam::find($id);
        if(request()->isMethod('post')){
            try{

                $images = [];
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/ourTeam/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/ourTeam', $photo_name);
               }else{
                // request()->image =  (new Image)->dirName('package')->file('image')
                // ->resizeImage(500, 500)
                // ->save();
               }

            if (request()->file('image')) {
                $ourTeam->update([
                    'name' => request('name'),
                    'title' => request('title'),
                    'sub_designation' => request('sub_designation'),
                    'image' => $photo_name,
                    'designation' => request('designation'),
                  ]);
            }else{
                $ourTeam->update([
                    'name' => request('name'),
                    // 'image' => $photo_name,
                    'designation' => request('designation'),
                  ]);
            }
              return to_route('ourTeam.list')->with('success', 'OurTeam Updated Successfully');
            }catch(PDOException $e){
               return redirect()->back()->with('error', 'Failed Please Try Again');
            }
           }
        return view('backend.ourTeam.editOurTeam',compact('data','ourTeam'));
    }
    public function ourTeam_delete($id)
    {
        OurTeam::find($id)->delete();
        return back()->with('success', 'Event Removed Successfully');
    }
}
