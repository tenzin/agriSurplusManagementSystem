<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CASurplusController extends Controller
{
    public function ca_surplus(){               //view
        
        return view('ca_nvsc.surplus.create');
    }

    public function submit_surplus_detail(){               //save second table
   
        return view('ca_nvsc.surplus.surplus_home');
    }

    public function view_surplus_details(){
        
        return view('ca_nvsc.surplus.surplus_home');
    }


}


