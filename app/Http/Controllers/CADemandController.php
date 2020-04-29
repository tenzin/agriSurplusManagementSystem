<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CADemandController extends Controller
{
    public function ca_surplus_demand(){               //view
        
        return view('ca_nvsc.demand.create');
    }

    public function submit_surplus_demand_form(){               //save first table
   
        return view('ca_nvsc.demand.surplus_demand_form_details');
    }

    public function submit_surplus_demand_detail(){               //save second table
   
       
        return view('ca_nvsc.demand.surplus_demand_home');
    }

    public function view_surplus_demand_details(){
        
        return view('ca_nvsc.demand.surplus_demand_home');
    }

    public function viewall_surplus_demand_details(){
        
        return view('ca_nvsc.demand.viewall_surplus_demand_details');
    }

    public function addmore_surplus_demand_details(){               // add more to second table
        //  dd('shdfgd');
        return view('ca_nvsc.demand.surplus_demand_form_details');
    }
}
