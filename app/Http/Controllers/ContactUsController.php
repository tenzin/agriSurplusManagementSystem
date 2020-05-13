<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\User;
use Auth;

use App\ContactUS;

class ContactUsController extends Controller
{
    public function contactUS()
    {
        $user = Auth::user();
    return view('usermanagement.contact',compact('user'));
    }
   /** * Show the application dashboard. * * @return \Illuminate\Http\Response */
   public function contactUSPost(Request $request)
   {
    //   $user= Auth::user();
    $this->validate($request, [
        'name' => 'required',
    'email' => 'required|email',
    'phone' => 'required',
    'text' => 'required' ]);
    ContactUS::create($request->all());


    Mail::send('email',
       array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'phone' => $request->get('phone'),
           'user_message' => $request->get('text')
       ), function($message)
   {


       $message->to(env('MAIL_USERNAME'), 'Admin')->subject('help desk');
   });
  //  return back()->with('success', 'Thanks for contacting us!');
  return redirect('/#contact')->with('success','Thank you for contacting us');


   }
}




