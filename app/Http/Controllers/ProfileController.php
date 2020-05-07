<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Role;
class ProfileController extends Controller
{
    public function userprofile(){
        $user = Auth::user();
        return view('usermanagement.userprofile',compact('user'));
    }
}
