<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Months;
use DB;

class CultivationReportController extends Controller
{

    public function __construct() {
      
        $this->middleware('auth');
        
    }

    public function search(){

        $user = auth()->user();
        
        $gewogs = DB::table('tbl_gewogs')
                        ->where('dzongkhag_id','=',$user->dzongkhag_id)                
                        ->get();
        $years = DB::table('tbl_transactions')
        ->select(DB::raw('year(submittedDate) as year'))
        ->distinct()
        ->get();

        $json_months_data = Months::getMonths();
        $months = $json_months_data->getData();

        $ptypes = DB::table('tbl_product_types')->get();
        
        return view('extension_farmer.reports.cultivationreport',compact('ptypes','gewogs','years','months'));
        
    }
}
