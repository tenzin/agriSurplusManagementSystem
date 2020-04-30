<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionSupplyController extends Controller
{
    public function extension_supply(){             //view 
        
        return view('extension_farmer.supply.create');
    }


    public function submit_supply_details(){            //save table
        
        return view('extension_farmer.supply.supply_home');
    }

    public function view_supply_details(){
        
        return view('extension_farmer.supply.supply_home');
    }


}
