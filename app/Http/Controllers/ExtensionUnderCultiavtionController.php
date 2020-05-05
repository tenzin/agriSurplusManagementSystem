<?php

namespace App\Http\Controllers;
use App\ProductType;

use Illuminate\Http\Request;

class ExtensionUnderCultiavtionController extends Controller
{
    public function extension_cultivation(){
        $productTypes = ProductType::all();
        return view('extension_farmer.cultivation.create',compact('productTypes'));
    }


    public function submit_cultivation_details(){            //save second table
        
        return view('extension_farmer.cultivation.cultivation_home');
    }

    public function view_cultivation_details(){
        
        return view('extension_farmer.cultivation.cultivation_home');
    }

    
}
