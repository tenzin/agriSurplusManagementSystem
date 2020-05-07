<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dzongkhag;
use App\Region;
class DzongkhagThromdeController extends Controller
{
    public function index(){

        $dzo = Dzongkhag::all();
        return view('Master.dzongkhag_thromde.index',compact('dzo'));
    }

    //add new Thromde.

    public function dzongkhagStore(Request $request)
    {
        $dzongkha = new Dzongkhag;
        $dzongkha->code = $request->code;
        $dzongkha->dzongkhag = $request->dzongkhag;
        $dzongkha->save();

        return redirect('dzongkhag-list')->with("success","Successfully added");
    }

     //edit.

     public function dzongkhagEdit($id)
     {
         $dzongkhag = Dzongkhag::find($id);
         $regions = Region::all();
         return view('Master.dzongkhag_thromde.dzongkhagedit',compact('dzongkhag','regions'));
          
     }

      //update.
      public function dzongkhagUpdate(Request $request,$id)
      {
          $dzongkha = Dzongkhag::find($id);
         // $dzongkha->code = $request->code;
          $dzongkha->dzongkhag = $request->dzongkhag;
          $dzongkha->region_id = $request->region;
          $dzongkha->save();
    
          return redirect('dzongkhag-list')->with("success","Successfully updated!");
           
      }

      //delete dzongkhag.
      public function dzongkhagDelete($id)
      {
          $dzongkhag = Dzongkhag::find($id);
          $dzongkhag->delete();

          return redirect("dzongkhag-list")->with("success","Successfully deleted!");
      }
}
