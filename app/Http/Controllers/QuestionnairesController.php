<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnairesController extends Controller
{
    public function questionnaires()
    {
        $data = array();
        $data['active_menu'] = 'questionnaires_list';
        $data['page_title'] = 'Questionnaires List';

        $questionnaires = Questionnaire::all();
        return view('backend.questionnaires.questionnaires_list',compact('data','questionnaires'));
    }
    public function questionnairesDelete($id)
    {
        Questionnaire::find($id)->delete();
        return to_route('questionnaires.list')->with('message','Deleted Successfully');
    }
}
