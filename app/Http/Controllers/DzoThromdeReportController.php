<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DzoThromdeReportController extends Controller
{
    //
    public function __construct() {
      
        $this->middleware('auth');
        
    }

    public function search()
    {
        $user = auth()->user();

        $ptypes = DB::table('tbl_product_types')->get();
        $gewogs = DB::table('tbl_gewogs')->where('dzongkhag_id','=',$user->dzongkhag_id)->get();

        return view('DzoThromde.dzothromdereport',compact('ptypes','gewogs'));
    }

    public function searchdreport(Request $request)
    {

        $user = auth()->user();
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        //surplus based on extension/farmer.
        if($request->rtype == "ex")
        {
            $title = "Surplus submitted by Gewog Extension Officer";

            $sql = "select tbl_product_types.type,tbl_products.product,tbl_ex_surplus.quantity,tbl_units.unit,
            tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus 
            join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
            join tbl_product_types on tbl_ex_surplus.productType_id = tbl_product_types.id
            join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
            join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
            join tbl_gewogs on tbl_transactions.gewog_id = tbl_gewogs.id
            where tbl_transactions.status in ('S','E') and tbl_transactions.dzongkhag_id=".$user->dzongkhag_id;
           // dd($sql);
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
        }
        else 
        {
            $title = "Surplus submitted by Commercial Aggregator";

            $sql = "select tbl_product_types.type,tbl_products.product,tbl_cssupply.quantity,tbl_units.unit,
            tbl_cssupply.created_at as 'harvestDate',tbl_cssupply.price,'' as 'gewog' from tbl_cssupply 
            join tbl_transactions on tbl_transactions.id = tbl_cssupply.trans_id
            join tbl_product_types on tbl_cssupply.productType_id = tbl_product_types.id
            join tbl_products on tbl_cssupply.product_id = tbl_products.id 
            join tbl_units on tbl_cssupply.unit_id = tbl_units.id
            where tbl_transactions.status in ('S','E') and tbl_transactions.dzongkhag_id=".$user->dzongkhag_id;
            //date between.         
            if(!empty($fromdate) && !empty($todate))
            {
            $sql = $sql. " and tbl_cssupply.created_at between '".$fromdate."' and '".$todate."'";   
            } 
            elseif(!empty($fromdate)){
                $sql = $sql. " and tbl_cssupply.created_at >= '".$fromdate."'";   
    
            }elseif( !empty($todate)) {
                //only $todate is set.
                $sql = $sql. " and tbl_cssupply.created_at <= '".$todate."'"; 
    
            }
            //    dd($sql);
    
            if(!empty($request->product_type))
            {
                $sql = $sql." and tbl_cssupply.productType_id = ".$request->product_type;
            }
    
            if(!empty($request->product))
            {
                $sql = $sql." and tbl_cssupply.product_id = ".$request->product;
            }
        }

       // dd($sql);
        $surplus = DB::select($sql);

        if($request->rtype == "ex")
        {
        return view('DzoThromde.dzothromdereportdetails',compact('surplus','fromdate','todate','title'));
        }
        else
        {
            return view('DzoThromde.dzothromdecareportdetails',compact('surplus','fromdate','todate','title'));   
        }

    }
}
