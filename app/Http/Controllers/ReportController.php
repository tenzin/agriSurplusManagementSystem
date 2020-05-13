<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use DB;
use App\Demand;
use App\Dzongkhag;

class ReportController extends Controller
{
    public function __construct(Request $request) {
        
        $this->request = $request;
        $this->middleware('auth');
    }
    //
    public function report()
    {
        $ptypes = ProductType::all();
        $details = Demand::all();
        $dzongkhags = Dzongkhag::all();

        return view("reports.report",compact("ptypes","details","dzongkhags"));
    }

    //search with parameters.
    public function search(Request $request)
    {
        $details = Demand::all();
        $ptypes = ProductType::all();
        $dzongkhags = Dzongkhag::all();

        return redirect("reports",compact("ptypes","details","dzongkhags"));

    }
}
