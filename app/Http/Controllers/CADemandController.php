<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CADemandController extends Controller
{
    public function ca_surplus_demand(){               //view
        
        return view('ca_nvsc.demand.create');
    }

    public function submit_surplus_demand_detail(){               //save second table
   
       
        return view('ca_nvsc.demand.surplus_demand_home');
    }

    public function view_surplus_demand_details(){
        
        return view('ca_nvsc.demand.surplus_demand_home');
    }
}
