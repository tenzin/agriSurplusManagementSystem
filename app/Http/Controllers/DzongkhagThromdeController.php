<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dzongkhag;
class DzongkhagThromdeController extends Controller
{
    public function index(){

        $dzo = Dzongkhag::all();
        return view('Master.dzongkhag_thromde.index',compact('dzo'));
    }
}
