<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\User;
use App\Transaction;
use Carbon\Carbon;

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
      $date = Carbon::now()->format('Y-m-d');

      Transaction::where('expiryDate', '<', $date)
         ->where('status','=', 'S')
         ->update([
           'status' => 'E'
        ]);

        return view('dashboard.nationaldashboard');

     }
}
