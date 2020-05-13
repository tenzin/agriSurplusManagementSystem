<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\User;

class DashboardController extends Controller
{

   public function __construct()
  {
      $this->middleware('auth');
      $this->user = \Auth::user();
  }

    public function extension(){

        return view('dashboard.extensiondashboard');
     }

     public function aggregator(){

        return view('dashboard.aggregatordashboard');
     }

     public function national(){
      // $products = Product::all();
      //   return view('dashboard.nationaldashboard',compact('products'));
      return view('dashboard.nationaldashboard');
      //   $surplus = DB::table('tbl_ex_surplus')
      //           ->where('refNumber', '=', $nextNumber)
      //           ->select('tbl_ex_surplus.product_id','')
      //           ->get();
      //   $count = DB::table('tbl_ex_surplus')
      //           ->where('refNumber', '=', $nextNumber)
      //           ->count();
      //    return view('dashboard.nationaldashboard','count');

     }
}
