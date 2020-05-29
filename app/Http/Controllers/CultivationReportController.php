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


    public function esult(Request $request)
    {
        $user = auth()->user();
        $gewog = $request->gewog;
        $fromdate = $request->fromdate;
       
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
       
       if(!empty($fromdate)){
            $sql = $sql. " and tbl_transactions.submittedDate >= '".$fromdate."'";   

       }
       else {
        //when dates are not selected. then year should be selected. default is current year.
        $sql = $sql. " and year(tbl_transactions.submittedDate) = ".$request->tyear; 
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


}
