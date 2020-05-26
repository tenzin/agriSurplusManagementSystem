<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\SummaryController;

class CAReportController extends Controller
{
    //

    public function __construct() {
      
        $this->middleware('auth');
        
    }

    public function searchby()
    {
        $user = auth()->user();
        
        $gewogs = DB::table('tbl_gewogs')
                        ->where('dzongkhag_id','=',$user->dzongkhag_id)                
                        ->get();

        $ptypes = DB::table('tbl_product_types')->get();
        
        return view('ca_nvsc.reports.careport',compact('ptypes','gewogs'));

    }

    public function search_result(Request $request)
    {
        $user = auth()->user();
        $gewog = $request->gewog;
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        
        $sql = "select tbl_ex_surplus.status,tbl_product_types.type,tbl_products.product,tbl_ex_surplus.quantity,tbl_units.unit,
        tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus 
        join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
        join tbl_product_types on tbl_ex_surplus.productType_id = tbl_product_types.id
        join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
        join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
        join tbl_gewogs on tbl_ex_surplus.gewog_id = tbl_gewogs.id
        where tbl_transactions.status in ('S','E') and tbl_transactions.dzongkhag_id=".$user->dzongkhag_id;
        
       
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
       
        if($request->gewog == "All")
        {
            $sql = $sql." and tbl_ex_surplus.dzongkhag_id = ".$user->dzongkhag_id;
           
        } 
        else
        {
            $sql = $sql." and tbl_ex_surplus.gewog_id = ".$gewog;
        }

        if(!empty($request->product_type))
        {
            $sql = $sql." and tbl_ex_surplus.productType_id = ".$request->product_type;
        }

        if(!empty($request->product))
        {
            $sql = $sql." and tbl_ex_surplus.product_id = ".$request->product;
        }

       // dd($sql);
        
        $surplus = DB::select($sql);

        return view('ca_nvsc.reports.reportdetails',compact('surplus','fromdate','todate'));
    }

    //searchsummaryby
    public function searchsummaryby()
    {
        $user = auth()->user();
        $gewogs = DB::table('tbl_gewogs')->where('dzongkhag_id','=',$user->dzongkhag_id)->get();
        return view('ca_nvsc.reports.summaryreport',compact('gewogs'));
    }
    //summaryreport
    public function summaryreport(Request $request)
    {

        $user = auth()->user();
        $selectedGewog = $request->gewog;
        $tyear = $request->tyear;
        $tmonth= $request->tmonth;
        $gewogname;
       
       
        //function to delete existing details and insert with updated details of the current month data into the tbl_monthly_quantity.
        SummaryController::delete_sum_aggregator();

        
        //if gewog is selected.
        if($selectedGewog == "All"){
            $summary = DB::table('tbl_monthly_quantity')
                        ->where('tbl_monthly_quantity.dzongkhag_id','=',$user->dzongkhag_id)
                        ->join('tbl_product_types','tbl_monthly_quantity.productType_id','tbl_product_types.id') 
                        ->join('tbl_units','tbl_monthly_quantity.unit_id','tbl_units.id')
                        ->join('tbl_gewogs','tbl_monthly_quantity.gewog_id','=','tbl_gewogs.id')
                        ->select('tbl_product_types.type','tbl_monthly_quantity.tmonth','tbl_monthly_quantity.tyear','tbl_monthly_quantity.quantity','tbl_units.unit','tbl_gewogs.gewog')
                        ->get();            
        }
        else{
            $summary = DB::table('tbl_monthly_quantity')
                        ->where('tbl_monthly_quantity.gewog_id','=',$selectedGewog)
                        ->join('tbl_product_types','tbl_monthly_quantity.productType_id','tbl_product_types.id') 
                        ->join('tbl_units','tbl_monthly_quantity.unit_id','tbl_units.id')
                        ->join('tbl_gewogs','tbl_monthly_quantity.gewog_id','=','tbl_gewogs.id')
                        ->select('tbl_product_types.type','tbl_monthly_quantity.tmonth','tbl_monthly_quantity.tyear','tbl_monthly_quantity.quantity','tbl_units.unit','tbl_gewogs.gewog')
                        ->get();            
            
        }


        return view('ca_nvsc.reports.summaryreportdetails',compact('summary','tyear','tmonth'));
    }
}
