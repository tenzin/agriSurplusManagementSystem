<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionSupplyController extends Controller
{
    public function extension_supply(){
        
        return view('extension_framer.supply.create');
    }

    public function submit_supply_form(){               //save first table
        
        return view('extension_framer.supply.supply_form_details');
    }

    public function submit_supply_details(){            //save second table
        
        return view('extension_framer.supply.supply_home');
    }

    public function view_supply_details(){
        
        return view('extension_framer.supply.supply_home');
    }

    public function viewall_supply_details(){
        
        return view('extension_framer.supply.viewall_supply_details');
    }

    public function addmore_supply_details(){               // add more to second table
        //  dd('shdfgd');
        return view('extension_framer.supply.supply_form_details');
    }

}
