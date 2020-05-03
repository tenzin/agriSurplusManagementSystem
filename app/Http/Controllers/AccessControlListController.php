<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessControlListController extends Controller
{
    public function userprofile(){
        
        return view('ACL.userprofile');
    }
    public function user(){
        
        return view('ACL.users');
    }
}
