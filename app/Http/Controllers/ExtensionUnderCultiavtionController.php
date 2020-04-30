<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionUnderCultiavtionController extends Controller
{
    public function extension_cultivation(){
        
        return view('extension_farmer.cultivation.create');
    }


    public function submit_cultivation_details(){            //save second table
        
        return view('extension_farmer.cultivation.cultivation_home');
    }

    public function view_cultivation_details(){
        
        return view('extension_farmer.cultivation.cultivation_home');
    }

    
}
