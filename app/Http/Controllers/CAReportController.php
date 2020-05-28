<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\SummaryController;
use App\Months;

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
        $years = DB::table('tbl_transactions')
        ->select(DB::raw('year(submittedDate) as year'))
        ->distinct()
        ->get();

        $json_months_data = Months::getMonths();
        $months = $json_months_data->getData();

        $ptypes = DB::table('tbl_product_types')->get();
        
        return view('ca_nvsc.reports.careport',compact('ptypes','gewogs','years','months'));

    }

    public function search_result(Request $request)
    {
        $user = auth()->user();
        $gewog = $request->gewog;
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        
        $sql = "select tbl_ex_surplus.status,tbl_product_types.type,tbl_products.product,
        tbl_ex_surplus.quantity,IFNULL((select sum(quantity) from tbl_ex_surplus_history where tbl_ex_surplus_history.ex_surplus_id=tbl_ex_surplus.id),0) as taken,
        tbl_units.unit,tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus 
        join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
        join tbl_product_types on tbl_ex_surplus.productType_id = tbl_product_types.id
        join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
        join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
        join tbl_gewogs on tbl_ex_surplus.gewog_id = tbl_gewogs.id
        where tbl_transactions.status ='S' and tbl_transactions.dzongkhag_id=".$user->dzongkhag_id;
        
       
       //date between.         
       if(!empty($fromdate) && !empty($todate))
       {
          $sql = $sql. " and tbl_transactions.submittedDate between '".$fromdate."' and '".$todate."'";   
       } 
       elseif(!empty($fromdate)){
            $sql = $sql. " and tbl_transactions.submittedDate >= '".$fromdate."'";   

       }elseif( !empty($todate)) {
           //only $todate is set.
            $sql = $sql. " and tbl_transactions.submittedDate <= '".$todate."'"; 

       }
       else {
        //when dates are not selected. then year should be selected. default is current year.
        $sql = $sql. " and year(tbl_transactions.submittedDate) = ".$request->tyear; 
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

    
    //summaryreport
    public function summaryreport(Request $request)
    {

        $user = auth()->user();
        $selectedGewog = $request->gewog;
        $tyear = $request->tyear;
        $tmonth= $request->tmonth;
       
       
        //function to delete existing details and insert with updated details of the current month data into the tbl_monthly_quantity.
        SummaryController::delete_sum_aggregator();


        $sql = "select tbl_product_types.type,tbl_units.unit,sum(quantity) as `quantity`,tmonth,tyear,tbl_gewogs.gewog
                from tbl_monthly_quantity
                join tbl_product_types on tbl_product_types.id = tbl_monthly_quantity.productType_id
                join tbl_units on tbl_units.id = tbl_monthly_quantity.unit_id
                join tbl_gewogs on tbl_gewogs.id = tbl_monthly_quantity.gewog_id
                where tbl_monthly_quantity.dzongkhag_id = ".$user->dzongkhag_id;


        if($tyear != "All")
        {
            $sql = $sql . " and tyear=".$tyear;
        }

        if($tmonth != "All")
        {
            $sql = $sql . " and tmonth=".$tmonth;
        }
       
        
        //if gewog is selected.
        if($selectedGewog != "All"){

            $sql = $sql . " and gewog_id =".$selectedGewog;
                 
        }
     
        $sql = $sql . " group by type,unit,tmonth,tyear,gewog_id";
       // dd($sql);
       $summary = DB::select($sql);
            
        return view('ca_nvsc.reports.summaryreportdetails',compact('summary','tyear','tmonth'));
    }
}
