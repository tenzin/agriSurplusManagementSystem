<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CAGewogController extends Controller
{
    //

    public function gewogsurplus()
    {
        $user = auth()->user();
      //  $dzongkhag_id = $user->dzongkhag_id;

    $gewogsupply = DB::table('tbl_ex_surplus')
    ->where('tbl_transactions.status','=','S')
    ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
    ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
    ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
    ->join('tbl_transactions','tbl_ex_surplus.refNumber', '=', 'tbl_transactions.refNumber')
    ->join('tbl_gewogs','tbl_transactions.gewog_id','=','tbl_gewogs.id')
    ->join('tbl_dzongkhags','tbl_transactions.dzongkhag_id','=','tbl_dzongkhags.id')
    ->select('tbl_transactions.location','tbl_units.unit','tbl_product_types.type','tbl_products.product', 'tbl_gewogs.gewog',            
        DB::raw("SUM(tbl_ex_surplus.quantity) as quantity"))
    ->groupBy('tbl_transactions.location','tbl_units.unit','tbl_transactions.gewog_id','tbl_product_types.type','tbl_products.product')
    ->orderBy('tbl_transactions.location')
    ->get();

    
    // ->select('tbl_units.unit','tbl_product_types.type','tbl_products.product', 'tbl_gewogs.gewog')
    
    return view('ca_nvsc.gewog_information.surplusofgewog',compact('gewogsupply'));

    }

}
