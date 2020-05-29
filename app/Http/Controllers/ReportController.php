<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use DB;
use App\Demand;
use App\EXSurplus;
use App\Dzongkhag;
use App\SurplusView;
use App\DemandView;

class ReportController extends Controller
{
    public $details;
    public function __construct() {
        
       // $this->request = $request;
        $this->middleware('auth');
    }
    //
    public function report()
    {
        $ptypes = ProductType::all();
        // $details = Demand::all();
        $dzongkhags = Dzongkhag::all();

        return view("reports.report",compact("ptypes","dzongkhags"));
    }

    //search with parameters.
    public function search(Request $request)
    {
       $type = $request->report_type;
       $fromdate = $request->fromdate;
       $todate = $request->todate;
       $ptype = $request->product_type;
       $product = $request->product;
       $dzongkhag = $request->dzongkhag;
       $gewog=$request->gewog;
       $dateSelected = $request->sdate;


        //type of report and query.
        if($type == "Surplus")
        {
            $sql = "select tbl_product_types.type,tbl_products.product,tbl_ex_surplus.quantity,
            IFNULL((select sum(quantity) from tbl_ex_surplus_history where tbl_ex_surplus_history.ex_surplus_id=tbl_ex_surplus.id),0) as taken,
            tbl_units.unit,tbl_ex_surplus.harvestDate,tbl_transactions.submittedDate,tbl_ex_surplus.price,tbl_gewogs.gewog,tbl_dzongkhags.dzongkhag
            from tbl_ex_surplus 
            join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
            join tbl_product_types on tbl_ex_surplus.productType_id = tbl_product_types.id
            join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
            join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
            join tbl_gewogs on tbl_transactions.gewog_id = tbl_gewogs.id
            join tbl_dzongkhags on tbl_transactions.dzongkhag_id = tbl_dzongkhags.id
            where tbl_transactions.status in ('S','E')";

            //based on selected date of either harvest or submitted. change column.
            if($dateSelected == "harvestDate") {  $column = " and tbl_ex_surplus.harvestDate "; }
            else {  $column = " and tbl_transactions.submittedDate "; }
              //date between.         
            if(!empty($fromdate) && !empty($todate))
            {
                $sql = $sql. $column ."between '".$fromdate."' and '".$todate."'";  
            } 
            elseif(!empty($fromdate))
            {  
                $sql = $sql. $column. ">= '".$fromdate."'";   
            }
            else
            {
                if(!empty($todate)) {   //only $todate is set.
                    $sql = $sql.$column. "<= '".$todate."'"; 
                }
            }

            if($ptype != "All")
            {
                $sql = $sql." and tbl_ex_surplus.productType_id = ".$request->product_type;
            }
    
            if($product != "All")
            {
                $sql = $sql." and tbl_ex_surplus.product_id = ".$request->product;
            }
            
            //check if dzongkhag and gewog selected.
            if($dzongkhag != "All")
            {
                $sql = $sql." and tbl_transactions.dzongkhag_id = ".$dzongkhag;
            }
            if($gewog != "All") 
            {
                $sql = $sql. " and tbl_transactions.gewog_id=".$gewog;
            }
    
        }
        else
        {
            $sql = "select tbl_product_types.type,tbl_products.product,tbl_gewogs.gewog,tbl_dzongkhags.dzongkhag,tbl_cultivations.quantity,tbl_cultivationunits.unit as `cunit`,
            tbl_cultivations.sowing_date,tbl_cultivations.estimated_output,tbl_cultivations.actual_output,tbl_units.unit as `eaunit`
            from tbl_cultivations
            join tbl_product_types on tbl_product_types.id = tbl_cultivations.productType_id
            join tbl_products on tbl_products.id=tbl_cultivations.product_id
            join tbl_cultivationunits on tbl_cultivationunits.id=tbl_cultivations.c_units
            join tbl_units on tbl_units.id=tbl_cultivations.e_units
            join tbl_gewogs on tbl_gewogs.id = tbl_cultivations.gewog_id
            join tbl_dzongkhags on tbl_dzongkhags.id = tbl_cultivations.dzongkhag_id ";

            if(!empty($fromdate) && !empty($todate))
            {
                $sql = $sql." where tbl_cultivations.sowing_date between '".$fromdate."' and '".$todate."'";  
            } 
            elseif(!empty($fromdate))
            {  
                $sql = $sql. " where tbl_cultivations.sowing_date >= '".$fromdate."'";   
            }
            else
            {
                if(!empty($todate)) {   //only $todate is set.
                    $sql = $sql." where tbl_cultivations.sowing_date <= '".$todate."'"; 
                }
            //     else
            //    {
            //        //default year.
            //   //   $sql = $sql." where year(tbl_cultivations.sowing_date)= ".date('Y'); 
            //    }
            }

            if($ptype != "All")
            {
                $sql = $sql." and tbl_cultivations.productType_id = ".$request->product_type;
            }
    
            if($product != "All")
            {
                $sql = $sql." and tbl_cultivations.product_id = ".$request->product;
            }
            
            //check if dzongkhag and gewog selected.
            if($dzongkhag != "All")
            {
                $sql = $sql." and tbl_cultivations.dzongkhag_id = ".$dzongkhag;
            }
            if($gewog != "All") 
            {
                $sql = $sql. " and tbl_cultivations.gewog_id=".$gewog;
            }
        }
             //  dd($sql);

       
        
    
        $details = DB::select($sql);
        
        if($type=="Surplus")
        {
            return view("reports.reportdetails",compact("details","type"));
        }
        else 
        { 
            return view("reports.cultivationdetails",compact("details","type"));
        }
    }
    
}
