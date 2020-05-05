<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use App\Product;
class ExtensionSupplyController extends Controller
{
    public function extension_supply(){             //view 
        
        $productTypes = ProductType::all();
        return view('extension_farmer.supply.create',compact('productTypes'));
    }


    public function submit_supply_details(){            //save table
        
        return view('extension_farmer.supply.supply_home');
    }

    public function view_supply_details(){
        
        return view('extension_farmer.supply.supply_home');
    }


}
