<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    //
    public function index(){

        $regions = Region::all();
        return view('Master.Regions.regionadd',compact('regions'));
    }

    //add new Thromde.

    public function regionStore(Request $request)
    {
        $region = new Region;
        $region->region = $request->region;
        $region->save();

        return redirect('region-list')->with("success","Successfully added");
    }

     //edit.

     public function regionEdit($id)
     {
         $region = Region::find($id);
         
         return view('Master.Regions.regionedit',compact('region'));
          
     }

      //update.
      public function regionUpdate(Request $request,$id)
      {
          $region = Region::find($id);
          $region->region = $request->region;
         
          $region->save();
    
          return redirect('region-list')->with("success","Successfully updated!");
           
      }

      //delete region.
      public function regionDelete($id)
      {
          $region = Region::find($id);
          $region->delete();

          return redirect("region-list")->with("success","Successfully deleted!");
      }
}
