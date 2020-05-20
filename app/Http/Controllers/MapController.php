<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gewog;
use DB;

class MapController extends Controller
{
    public function index(){

        // $mapping = Gewog::all()->toArray();

        // $mapping = DB::table('tbl_gewogs')->first();

        // // dd($mapping->id);
        // return view('index',compact('mapping'));
        // // dd('sdjfkh');
    
        $gewog = DB::table('tbl_gewogs')
           ->where('tbl_gewogs.dzongkhag_id','=',1)
            ->join('tbl_dzongkhags','tbl_gewogs.dzongkhag_id','=', 'tbl_dzongkhags.id')
            ->select('tbl_gewogs.gewog') 
            ->get();
        //dd($gewog);

          return view('index',compact('gewog'));

    }
}
