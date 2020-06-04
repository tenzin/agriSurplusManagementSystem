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
                      select productType_id,sum(quantity) as `quantity`,
                      unit_id,tbl_transactions.gewog_id,tbl_transactions.dzongkhag_id,month(harvestDate) as `tmonth`,year(harvestDate) as `tyear`
                      from tbl_ex_surplus 
                      join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
                      where tbl_transactions.gewog_id=".$user->gewog_id." and month(tbl_ex_surplus.harvestDate)=".$cmonth." and year(tbl_ex_surplus.harvestDate)=".$cyear." 
                      and tbl_transactions.status in ('S','E')
                      group by productType_id,tbl_transactions.gewog_id,unit_id,tbl_transactions.dzongkhag_id,tmonth,tyear";
            
        $sqlInsert = $sqlInsert. " union select productType_id,sum(quantity) as `quantity`,
                      unit_id,tbl_transactions.gewog_id,tbl_transactions.dzongkhag_id,month(harvestDate) as `tmonth`,year(harvestDate) as `tyear`
                      from tbl_ex_surplus_history                       
                      join tbl_transactions on tbl_transactions.id = tbl_ex_surplus_history.trans_id
                      where tbl_transactions.gewog_id=".$user->gewog_id." and month(tbl_ex_surplus_history.harvestDate)=".$cmonth." and year(tbl_ex_surplus_history.harvestDate)=".$cyear." 
                      and tbl_transactions.status in ('S','E')
                      group by productType_id,tbl_transactions.gewog_id,unit_id,tbl_transactions.dzongkhag_id,tmonth,tyear";              

            //  dd($sqlInsert);      
        
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
                      select tbl_ex_surplus.productType_id,sum(tbl_ex_surplus.quantity) as `quantity`,
                      tbl_ex_surplus.unit_id,tbl_transactions.gewog_id,tbl_transactions.dzongkhag_id,month(tbl_ex_surplus.harvestDate) as `tmonth`,year(tbl_ex_surplus.harvestDate) as `tyear`
                      from tbl_ex_surplus                       
                      join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
                      where tbl_transactions.dzongkhag_id=".$user->dzongkhag_id." and month(tbl_ex_surplus.harvestDate)=".$cmonth." and year(tbl_ex_surplus.harvestDate)=".$cyear." 
                      and tbl_transactions.status in ('S','E')
                      group by productType_id,tbl_transactions.gewog_id,unit_id,tbl_transactions.dzongkhag_id,tmonth,tyear";                    

                      $sqlInsert = $sqlInsert. " union select tbl_ex_surplus_history.productType_id,sum(tbl_ex_surplus_history.quantity) as `quantity`,
                      tbl_ex_surplus_history.unit_id,tbl_transactions.gewog_id,tbl_transactions.dzongkhag_id,month(tbl_ex_surplus_history.harvestDate) as `tmonth`,year(tbl_ex_surplus_history.harvestDate) as `tyear`
                      from tbl_ex_surplus_history 
                      join tbl_ex_surplus on tbl_ex_surplus.id = tbl_ex_surplus_history.ex_surplus_id                   
                      join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id
                      where tbl_transactions.dzongkhag_id=".$user->dzongkhag_id." and month(tbl_ex_surplus_history.harvestDate)=".$cmonth." and year(tbl_ex_surplus_history.harvestDate)=".$cyear." 
                      and tbl_transactions.status in ('S','E')
                      group by productType_id,tbl_transactions.gewog_id,unit_id,tbl_transactions.dzongkhag_id,tmonth,tyear";                    

       // dd($sqlInsert);

        DB::statement($sqlInsert);    

       
    }

}
