<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CAFilterController extends Controller
{
    public function scopefilter(){

        // dd('sdfsd');
        return view('ca_nvsc.search.filter');
    }

    public function view_claim(){

        return view('ca_nvsc.search.view_claimed');
    }
}
