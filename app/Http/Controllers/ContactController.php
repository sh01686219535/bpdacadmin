<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactList()
    {
        $data = array();
        $data['active_menu'] = 'contact';
        $data['page_title'] = 'Contact Us';
        $contact = Contact::get();
        return view('backend.contact.contactList',compact('contact','data'));
    }
}
