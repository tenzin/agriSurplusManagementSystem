<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\SummaryController;

class EXReportController extends Controller
{
    //
    
    public function __construct() {
      
        $this->middleware('auth');
        
    }

    public function searchby()
    {

        $ptypes = DB::table('tbl_product_types')->get();
        
        return view('extension_farmer.reports.report',compact('ptypes'));

    }

    public function search_result(Request $request)
    {
      
        $user = auth()->user();

        
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $sql = "select tbl_ex_surplus.status,tbl_product_types.type,tbl_products.product,tbl_ex_surplus.quantity,tbl_units.unit,
        tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus join tbl_product_types on 
        tbl_ex_surplus.productType_id = tbl_product_types.id
        join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
        join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
        join tbl_gewogs on tbl_ex_surplus.gewog_id = tbl_gewogs.id
        where exists (select refNumber from tbl_transactions where status in ('S','E') and user_id = ".$user->id." and gewog_id = ".$user->gewog_id." and dzongkhag_id=".$user->dzongkhag_id.")
       ";
       // dd($sql);
     
       //status of submission. 'S'.
       $sql = $sql." and tbl_ex_surplus.gewog_id=".$user->gewog_id; 
       
       //date between.         
       if(!empty($fromdate) && !empty($todate))
       {
          $sql = $sql. " and tbl_ex_surplus.harvestDate between '".$fromdate."' and '".$todate."'";   
       } 
       elseif(!empty($fromdate)){
            $sql = $sql. " and tbl_ex_surplus.harvestDate >= '".$fromdate."'";   

       }elseif( !empty($todate)) {
           //only $todate is set.
            $sql = $sql. " and tbl_ex_surplus.harvestDate <= '".$todate."'"; 

       }
       
    //    dd($sql);

        if(!empty($request->product_type))
        {
            $sql = $sql." and tbl_ex_surplus.productType_id = ".$request->product_type;
        }

        if(!empty($request->product))
        {
            $sql = $sql." and tbl_ex_surplus.product_id = ".$request->product;
        }

        //dd($sql);
        
        $surplus = DB::select($sql);

        return view('extension_farmer.reports.reportdetails',compact('surplus','fromdate','todate'));
    }

    public function searchby_summary(){
        return view('extension_farmer.reports.summaryreport');
    }
    //call summary report.
    public function summary_report(Request $request)
    {

        $user = auth()->user();
        $tyear = $request->tyear;
        $tmonth= $request->tmonth;

        //first call function to delete existing details and insert updated details of the current month from the tbl_monthly_quantity.
        SummaryController::sum_quantity_type();

        $sql = "select tbl_product_types.type,tbl_monthly_quantity.tmonth,tbl_monthly_quantity.tyear,tbl_monthly_quantity.quantity,tbl_units.unit from tbl_monthly_quantity 
                join tbl_product_types on tbl_product_types.id = tbl_monthly_quantity.productType_id
                join tbl_units on tbl_units.id = tbl_monthly_quantity.unit_id
                where tbl_monthly_quantity.gewog_id=".$user->gewog_id;

        if($tyear !== "All")
        {
            $sql = $sql." and tbl_monthly_quantity.tyear=".$tyear;
        }

        if($tmonth !== "All")
        {
            $sql = $sql . " and tbl_monthly_quantity.tmonth=".$tmonth;
        }

        $summary = DB::select($sql);
       // dd($sql);

        //dd($sql);

        return view('extension_farmer.reports.summaryreportdetails',compact('summary','tyear','tmonth'));
    }
}
