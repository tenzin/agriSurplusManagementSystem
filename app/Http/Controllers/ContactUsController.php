<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use Mail;

class ContactUsController extends Controller
{
   public function contactUS(){
      return view('usermanagement.contact');
    }

    public function contactUSPost(Request $request)
   {
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'text' => 'required' ]);
   ContactUs::create($request->all());


    Mail::send('email',
       array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'phone' => $request->get('phone'),
           'user_message' => $request->get('text')
       ), function($message)
   {
       $message->from('$user->email');
       $message->to(env('MAIL_USERNAME'), 'Admin')->subject('Help Desk');
   });
  return back()->with('success','Thank you for contacting us.Will back you soon ');


   }
}
