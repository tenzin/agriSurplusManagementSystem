<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;
use App\User;
use App\Dzongkhag;
use App\Role;
use App\Gewog;

class AccessControlListController extends Controller
{
    public function userprofile(){
        
        return view('ACL.userprofile');
    }
    public function user(){
        $users = User::all();
        return view('ACL.users', compact('users'));
    }
    public function add(){
        $dzongkhags = Dzongkhag::all();
        $roles = Role::all();
        $gewogs = Gewog::all();
        return view('ACL.adduser',compact('dzongkhags','roles','gewogs'));
    }
      public function insert(Request $request){

        $insert = new User;
        $insert->cid= $request->cid;
        $insert->name=$request->name;
        $insert->dzongkhag_id= $request->dzongkhag;
        $insert->gewog_id=$request->gewog;
        $insert->role_id=$request->role;
        $insert->address=$request->address;
        $insert->contact_number=$request->number;
        $insert->email=$request->email;
         $insert->password=Hash::make($request->password);
        // $insert->submitted_by=Auth::user()->id;
        $insert->save();
       
        return redirect()->route('e_govform.view')->with('success','Added successfully');
    
        }
    


    public function userView(){
        $users = User::all();
        return view('ACL.userview', compact('users'));
    }
}
