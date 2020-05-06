<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
class ProductController extends Controller
{
    //create product.
    public function productcreate()
    {
        $products = Product::latest()->get();
        $ptypes = ProductType::all();
        return view('Master.products.productcreate',compact('ptypes','products'));
    }


    //store product.
    public function productstore(Request $request)
    {
        $product = new Product;

        $product->productType_id = $request->product_type;
        $product->product = $request->product;
        $product->save();

        //add another product.
       
        return redirect('product-create')->with("success","successfully added!");
    }

    public function productedit($id)
    {
        $product = Product::find($id);
        $ptypes = ProductType::all();
        return view('Master.products.productedit',compact('product','ptypes'));

    }

    //update product.
    public function productupdate(Request $request, $id) 
    {
        $product = Product::find($id);
        $product->productType_id = $request->product_type;
        $product->product = $request->product;
        $product->save();

        return redirect("product-edit/".$id)->with("success","Successfully updated!");
    }

    public function Productdestroy($id) {

        $product = Product::find($id);
        $product->delete();
        return redirect('product-create')->with("success",'Successfully deleted the permission');
  
      }

}
