<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm() {
        if(\Auth::check())
        {
          return  redirect('/');
        }
      else return view('auth.login');
      }
  
      public function login(Request $request) {
        $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required',
          
        ]);
          if (\Auth::attempt([
              'email' => $request->email,
              'password' => $request->password])
          ){
              return redirect('/dashboard');
          }
          else return redirect('/login')->with('error', 'Invalid Email address or Password');
  
      }
  
  
      public function logout(Request $request)
    {
      if(\Auth::check())
      {
        \Auth::logout();
        $request->session()->invalidate();
  
      }
    //return  redirect('/login');
    return redirect(\URL::previous());
  
    }
}
