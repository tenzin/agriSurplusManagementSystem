<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class SummaryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        
    }


    public static function sum_quantity_type()
    {
        //for aggregator and above level.
        $user = auth()->user();
       
        $cmonth = date("n");
        $cyear = date("Y");
       
        $wherestm = " where gewog_id ='".$user->gewog_id."'";
    
         //delete existing of the current month.
        $deletesql = "delete from tbl_monthly_quantity".$wherestm." and tmonth=".$cmonth." and tyear=".$cyear;
        //dd($deletesql);

        DB::statement($deletesql);
        
        $sqlInsert = "insert into tbl_monthly_quantity(productType_id,quantity,unit_id,gewog_id,dzongkhag_id,tmonth,tyear)
                      select productType_id,sum(quantity) as `quantity`,unit_id,gewog_id,dzongkhag_id,month(created_at) as `tmonth`,year(created_at) as `tyear`
                      from tbl_ex_surplus ".$wherestm." and month(harvestDate)=".$cmonth." and year(harvestDate)=".$cyear." and tbl_ex_surplus.status in ('S','E') 
                      group by productType_id,gewog_id,unit_id,dzongkhag_id,tmonth,tyear";
        
        DB::statement($sqlInsert);              

        //dd($sqlInsert);             
    }

    //for aggregator.
    public static function delete_sum_aggregator()
    {
        $user = auth()->user();
       
        $cmonth = date("n");
        $cyear = date("Y");

        $wherestm = " where dzongkhag_id =".$user->dzongkhag_id;

        $deletesql = "delete from tbl_monthly_quantity".$wherestm." and tmonth=".$cmonth." and tyear=".$cyear;
        //dd($deletesql);

        DB::statement($deletesql);
        
        $sqlInsert = "insert into tbl_monthly_quantity(productType_id,quantity,unit_id,gewog_id,dzongkhag_id,tmonth,tyear)
                      select productType_id,sum(quantity) as `quantity`,unit_id,gewog_id,dzongkhag_id,month(created_at) as `tmonth`,year(created_at) as `tyear`
                      from tbl_ex_surplus ".$wherestm." and month(harvestDate)=".$cmonth." and year(harvestDate)=".$cyear." and tbl_ex_surplus.status in ('S','E')
                      group by productType_id,gewog_id,unit_id,dzongkhag_id,tmonth,tyear";

        DB::statement($sqlInsert);    

       
    }

}
