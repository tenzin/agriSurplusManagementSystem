<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
class ProductTypeController extends Controller
{
    //view to add product type.
    public function producttype()
    {
        $ptypes = ProductType::latest()->get();
        return view('Master.product_type.producttypeadd',compact('ptypes'));
    } 
    //save a product type.
    public function producttypestore(Request $request)
    {
         $ptype = new ProductType;
         $ptype->type = $request->producttype;
         $ptype->save();

         //  return redirect('product-type-list')->with("success","Successfully saved!");
         return redirect('product-type')->with("success","Successfully saved!");
    }
    
    //populate field in editview to change type.
    public function producttypeedit($id)
    {
   
     $producttypes = ProductType::find($id); 

     return view('Master.product_type.producttypeedit',compact('producttypes'));

    } 

    //update the changes of type.
    public function producttypeupdate(Request $request,$id)
    {
        $producttypes = ProductType::find($id);
        $producttypes->type = $request->producttype;
        $producttypes->save();

        return redirect('product-type')->with("success","Successfully updated!");
    }

    //delete type.
    public function producttypedelete($id)
    {
        ProductType::destroy($id);
        
        return redirect('product-type')->with("success","Successfully deleted!");
    }
}
