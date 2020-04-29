<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function extension(){

        return view('dashboard.extensiondashboard');
     }

     public function aggregator(){

        return view('dashboard.aggregatordashboard');
     }

     public function national(){

        return view('dashboard.nationaldashboard');
     }
}
