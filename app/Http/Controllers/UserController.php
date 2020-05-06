<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use GuzzleHttp\Client;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update_avatar(Request $request){

        $request->validate([
          'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
  
      $user = Auth::user();
      $dir ='profilepic/';
  
  
      $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
  
      $request->avatar->move($dir,$avatarName);
  
      $user->avatar = $avatarName;
  
      $user->save();
  
  
      return back()
          ->with('success','You have successfully upload image.');
  
          return back();
  
    }
}
