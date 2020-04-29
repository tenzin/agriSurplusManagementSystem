<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionDemandController extends Controller
{
    public function extension_demand(){
        
        return view('extension_framer.demand.create');
    }

    public function submit_demand_form(){               //save first table
        
        return view('extension_framer.demand.demand_form_details');
    }

    public function submit_demand_details(){               //save second table
        
        return view('extension_framer.demand.demand_home');
    }

    public function view_demand_details(){
        
        return view('extension_framer.demand.demand_home');
    }

    public function viewall_demand_details(){
        
        return view('extension_framer.demand.viewall_demand_details');
    }

    public function addmore_demand_details(){               //add more to second table
        //  dd('shdfgd');
        return view('extension_framer.demand.demand_form_details');
    }
}
