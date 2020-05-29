<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\SummaryController;
use App\Months;

class EXReportController extends Controller
{
    //
    public function __construct() {
      
        $this->middleware('auth');
        
    }

    public function searchby()
    {

        $ptypes = DB::table('tbl_product_types')->get();
        $years = DB::table('tbl_transactions')
                        ->select(DB::raw('year(submittedDate) as year'))
                        ->distinct()
                        ->get();

        $json_months_data = Months::getMonths();
        $months = $json_months_data->getData();
       // dd($months); 
        return view('extension_farmer.reports.report',compact('ptypes','years','months'));

    }

    //filter total surplus.
    public function searchtotalby()
    {
        $ptypes = DB::table('tbl_product_types')->get();
        $months = Months::getMonths();
        
        return view('extension_farmer.reports.totalsurplus',compact('ptypes','months'));
    }

    //view total surplus.
    public function search_totalresult(Request $request)
    {
        $user = auth()->user();
        $title = "Total Surplus";
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $sql = "select tbl_ex_surplus.status,tbl_product_types.type,tbl_products.product, tbl_units.unit,
        tbl_ex_surplus.quantity,IFNULL((select sum(quantity) from tbl_ex_surplus_history where tbl_ex_surplus_history.ex_surplus_id=tbl_ex_surplus.id),0) as quantity,
        tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus join tbl_product_types on 
        tbl_ex_surplus.productType_id = tbl_product_types.id
        join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
        join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
        join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
        join tbl_gewogs on tbl_ex_surplus.gewog_id = tbl_gewogs.id
        where tbl_transactions.status in ('S','E')";
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

        return view('extension_farmer.reports.reportdetails',compact('surplus','fromdate','todate','title'));

    }

    public function search_result(Request $request)
    {
      
        $user = auth()->user();

        $title = "Surplus Submitted";
        $fromdate = $request->fromdate;
        $todate = $request->todate;


        $sql = "select tbl_ex_surplus.status,tbl_product_types.type,tbl_products.product, tbl_units.unit,
        tbl_ex_surplus.quantity,IFNULL((select sum(quantity) from tbl_ex_surplus_history where tbl_ex_surplus_history.ex_surplus_id=tbl_ex_surplus.id),0) as taken,
        tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus join tbl_product_types on 
        tbl_ex_surplus.productType_id = tbl_product_types.id
        join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
        join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
        join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
        join tbl_gewogs on tbl_ex_surplus.gewog_id = tbl_gewogs.id
        where tbl_transactions.status in ('S','E')";
      

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
       else {
           //when dates are not selected. then year should be selected. default is current year.
           if($request->tyear != "All")
            {
                $sql = $sql. " and year(tbl_ex_surplus.harvestDate) = ".$request->tyear; 
            }
       }
       
       // dd($sql);

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

        return view('extension_farmer.reports.reportdetails',compact('surplus','fromdate','todate','title'));
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


        return view('extension_farmer.reports.summaryreportdetails',compact('summary','tyear','tmonth'));
    }
}
