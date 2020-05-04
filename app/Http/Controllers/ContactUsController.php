<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function user(){
        
        return view('usermanagement.userprofile');
    }

    public function contact(){
        
        return view('usermanagement.contact');
    }
}
