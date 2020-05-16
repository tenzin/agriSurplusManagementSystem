<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductType;
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

       $producttype = ProductType::all();
       $product = Product::all();
       $farmer = User::where('role_id','9')->count();
       $luc = User::where('role_id','8')->count();
       $ardc = User::where('role_id','6')->count();
       $vsc = User::where('role_id','5')->count();
        return view('dashboard.extensiondashboard',compact(
           'producttype',
           'product',
           'farmer',
           'luc',
           'ardc',
           'vsc'
         ));
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
