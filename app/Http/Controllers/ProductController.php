<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
class ProductController extends Controller
{
    //list all products.
    public function productlist()
    {
        $products = Product::paginate(10);
        return view('Master.products.productlist',compact('products'));
    }
    //create product.
    public function productcreate()
    {
        $ptypes = ProductType::all();
        return view('Master.products.productcreate',compact('ptypes'));
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
     
        //list all products.
        // $products = Product::paginate(10);
        // return redirect('Master.products.productlist',compact('products'));
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

    //delete product.
    public function productdelete($id)
    {
        Product::destroy($id);
        return redirect("product")->with("success","Successfully deleted!");
    }

}
