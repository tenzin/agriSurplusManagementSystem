<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UpdateDetailsController extends Controller
{
    public function changePassword(Request $request){
        
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function changeEmail(Request $request){
        
        $validatedData = $request->validate([
            'email' => 'required',
            
        ]);
        //Change Email
        $user = Auth::user();
        $user->email = $request->get('email');
        $user->save();
        return redirect()->back()->with("success","Email changed successfully !");
    }
    public function changeContact(Request $request){
        
        $validatedData = $request->validate([
            'phone' => 'required',
            
        ]);
        
        $user = Auth::user();
        $user->contact_number = $request->get('phone');
        $user->save();
        return redirect()->back()->with("success","Contact number  changed successfully !");
    }
}
