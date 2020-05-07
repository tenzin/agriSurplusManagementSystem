<?php

namespace App\Http\Controllers;
use App\Product;
use App\Cunit;
use App\Unit;
use App\Cultivation;
use Auth;
use Illuminate\Http\Request;

class ExtensionUnderCultiavtionController extends Controller
{
    public function extension_cultivation(){
        $product = Product::with('productType')->get();
        $c_unit = Cunit::get();
        $e_unit = Unit::get();
        return view('extension_farmer.cultivation.create',compact('product','c_unit','e_unit'));
    }


    public function submit_cultivation_details(Request  $request){            //save second table


        $cultivation= new Cultivation;
        $cultivation->product_id=$request->crop;
        $cultivation->c_units = $request->unit;
        $cultivation->e_units=$request->e_unit;
        $cultivation->quantity=$request->quantity;
        $cultivation->sowing_date=$request->pickup_date;
        $cultivation->estimated_output=$request->output;
        $cultivation->remarks=$request->remarks;
        $cultivation->user_id=Auth::user()->id;
        $cultivation->dzongkhag_id=Auth::user()->dzongkhag_id;
        $cultivation->gewog_id=Auth::user()->gewog_id;
        $cultivation->status=0;
        // dd($cultivation);
        $cultivation->save();  
        
        return redirect('view_cultivation_details')->with('success','You have successfully entered cultivation deltails.');
    }

    public function view_cultivation_details(){
        $cultivations = Cultivation::with('c_unit','e_unit','product')->where('gewog_id', Auth::user()->gewog_id)->latest()->get();;
        return view('extension_farmer.cultivation.cultivation_home',compact('cultivations'));
    }

    public function update_cultivation_status($id){

        $user = new Cultivation;
          $user::where('id',$id)
              ->update([
                  'status' => 1,     
            ]);
        return back();
      }

    
}
