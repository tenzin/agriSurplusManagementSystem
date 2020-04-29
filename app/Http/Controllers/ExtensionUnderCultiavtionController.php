<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionUnderCultiavtionController extends Controller
{
    public function extension_cultivation(){
        
        return view('extension_farmer.cultivation.create');
    }

    public function submit_cultivation_form(){               //save first table
        
        return view('extension_farmer.cultivation.cultivation_form_details');
    }

    public function submit_cultivation_details(){            //save second table
        
        return view('extension_farmer.cultivation.cultivation_home');
    }

    public function view_cultivation_details(){
        
        return view('extension_farmer.cultivation.cultivation_home');
    }

    public function viewall_cultivation_details(){
        
        return view('extension_farmer.cultivation.viewall_cultivation_details');
    }

    public function addmore_cultivation_details(){               // add more to second table
        //  dd('shdfgd');
        return view('extension_farmer.cultivation.cultivation_form_details');
    }
}
