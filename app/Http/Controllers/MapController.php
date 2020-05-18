<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gewog;
use DB;

class MapController extends Controller
{
    public function index(){

        $mapping = Gewog::all()->toArray();
        // dd($map);
        return view('index',compact('mapping'));
        // dd('sdjfkh');
    }
}
