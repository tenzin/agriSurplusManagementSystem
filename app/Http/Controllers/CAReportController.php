<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CAReportController extends Controller
{
    //

    public function __construct() {
      
        $this->middleware('auth');
        
    }

    public function searchby()
    {
        $user = auth()->user();

        //search to date is to be made default to 7 week.
        
        $gewogs = DB::table('tbl_gewogs')
                        ->where('dzongkhag_id','=',$user->dzongkhag_id)                
                        ->get();

        $ptypes = DB::table('tbl_product_types')->get();
        
        return view('ca_nvsc.reports.careport',compact('ptypes','gewogs'));

    }

    public function search_result(Request $request)
    {
        $gewog = $request->gewog;
        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $gewogname=null;

        if(!empty($gewog))
        {
            $gewogname = DB::table('tbl_gewogs')->where('id','=',$gewog)->get('gewog')->first();
        }

        $sql = "select tbl_transactions.status,tbl_product_types.type,tbl_products.product,tbl_ex_surplus.quantity,tbl_units.unit,
        tbl_ex_surplus.harvestDate,tbl_ex_surplus.price,tbl_gewogs.gewog from tbl_ex_surplus join tbl_product_types on 
        tbl_ex_surplus.productType_id = tbl_product_types.id
        join tbl_products on tbl_ex_surplus.product_id = tbl_products.id 
        join tbl_units on tbl_ex_surplus.unit_id = tbl_units.id
        join tbl_transactions on tbl_ex_surplus.refNumber = tbl_transactions.refNumber
        join tbl_gewogs on tbl_transactions.gewog_id = tbl_gewogs.id
        ";

        
       //status of submission. 'S'.
       $sql = $sql." where tbl_transactions.status IN ('S','E')"; 
       
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
       
        if(!empty($request->gewog))
        {
            $sql = $sql." and tbl_transactions.gewog_id = ".$gewog;
           
        }

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

        return view('extension_farmer.reports.reportdetails',compact('surplus','gewogname','fromdate','todate'));
    }
}
