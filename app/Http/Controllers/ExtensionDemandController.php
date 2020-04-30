<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionDemandController extends Controller
{
    public function extension_demand(){
        
        return view('extension_farmer.demand.create');
    }

   

    public function submit_demand_details(){               //save second table
        
        return view('extension_farmer.demand.demand_home');
    }

    public function view_demand_details(){
        
        return view('extension_farmer.demand.demand_home');
    }

    
}
