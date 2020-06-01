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
        $years = DB::table('tbl_cultivations')
                ->select(DB::raw('year(sowing_date) as year'))
                ->distinct()
                ->get();

        $json_months_data = Months::getMonths();
        $months = $json_months_data->getData();

        $ptypes = DB::table('tbl_product_types')->get();
        
        return view('extension_farmer.reports.cultivationreport',compact('ptypes','years','months','gewogs'));
        
    }


    public function return_search(Request $request)
    {
        $user = auth()->user();
        $gewog = $request->gewog;
        $tmonth = $request->tmonth;
       
        $sql = "select tbl_product_types.type,tbl_products.product,tbl_cultivations.quantity,tbl_cultivationunits.unit as `cunit`,
        tbl_cultivations.sowing_date,tbl_cultivations.estimated_output,tbl_cultivations.actual_output,tbl_units.unit as `eaunit`
        from tbl_cultivations
        join tbl_product_types on tbl_product_types.id = tbl_cultivations.productType_id
        join tbl_products on tbl_products.id=tbl_cultivations.product_id
        join tbl_cultivationunits on tbl_cultivationunits.id=tbl_cultivations.c_units
        join tbl_units on tbl_units.id=tbl_cultivations.e_units
        join tbl_gewogs on tbl_gewogs.id = tbl_cultivations.gewog_id
        where tbl_cultivations.gewog_id=".$user->gewog_id;

    
        //report type either harvested or area under cultivation.

        if($request->report_type == "harvested")
        {
            $sql = $sql." and tbl_cultivations.status=1";
        }
        else{
            $sql = $sql." and tbl_cultivations.status=0";
        }
        
       //clause if month is selected.
       if($tmonth != "All")
       {
           $sql = $sql. " and month(sowing_date) = ".$tmonth;
       }
       
        if(!empty($request->product_type))
        {
            $sql = $sql." and tbl_cultivations.productType_id = ".$request->product_type;
        }

        if(!empty($request->product))
        {
            $sql = $sql." and tbl_cultivations.product_id = ".$request->product;
        }

       // dd($sql);
        
        $cultivations = DB::select($sql);

        return view('extension_farmer.reports.cultivationdetails',compact('cultivations','tmonth'));
    }


    public function harvest_search(Request $request)
    {
        $user = auth()->user();
        $gewog = $request->gewog;
        $tmonth = $request->tmonth;
       
        $sql = "select tbl_product_types.type,tbl_products.product,tbl_cultivations.quantity,tbl_cultivationunits.unit as `cunit`,
        tbl_cultivations.sowing_date,tbl_cultivations.estimated_output,tbl_cultivations.actual_output,tbl_units.unit as `eaunit`
        from tbl_cultivations
        join tbl_product_types on tbl_product_types.id = tbl_cultivations.productType_id
        join tbl_products on tbl_products.id=tbl_cultivations.product_id
        join tbl_cultivationunits on tbl_cultivationunits.id=tbl_cultivations.c_units
        join tbl_units on tbl_units.id=tbl_cultivations.e_units
        join tbl_gewogs on tbl_gewogs.id = tbl_cultivations.gewog_id
        where tbl_cultivations.gewog_id=".$user->gewog_id;

    
        //report type either harvested or area under cultivation.

        if($request->report_type == "harvested")
        {
            $sql = $sql." and tbl_cultivations.status=1";
        }
        else{
            $sql = $sql." and tbl_cultivations.status=0";
        }
        
       //clause if month is selected.
       if($tmonth != "All")
       {
           $sql = $sql. " and month(sowing_date) = ".$tmonth;
       }
       
        if(!empty($request->product_type))
        {
            $sql = $sql." and tbl_cultivations.productType_id = ".$request->product_type;
        }

        if(!empty($request->product))
        {
            $sql = $sql." and tbl_cultivations.product_id = ".$request->product;
        }

       // dd($sql);
        
        $cultivations = DB::select($sql);

        return view('extension_farmer.reports.harvestcultivation',compact('cultivations','tmonth'));
    }
}
