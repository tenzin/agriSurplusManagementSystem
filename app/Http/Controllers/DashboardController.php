<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductType;
use App\User;
use App\Transaction;
use DB;
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
       $ca = User::where('role_id','4')->count();

        return view('dashboard.extensiondashboard',compact(
           'producttype',
           'product',
           'farmer',
           'luc',
           'ardc',
           'vsc',
            'ca'
         ));
     }

     public function aggregator()
     {
      $d=auth()->user()->dzongkhag_id;
      
      $producttype = ProductType::all();
      $location=Transaction::all();

       $farmer = User::where('dzongkhag_id', '=', $d)
                 ->where('role_id','9')->count();
        $ex = User::where('dzongkhag_id', '=', $d)
                 ->where('role_id','7')->count();
        $luc = User::where('dzongkhag_id', '=', $d)
                ->where('role_id','8')->count();
        $ca = User::where('role_id', '4')->count();

      $users_data = User::where('dzongkhag_id', '=', $d)
                       ->where('role_id', '=', 7)->with('gewog')->get(); 
                      
        return view('dashboard.aggregatordashboard',compact(
            'producttype',
            'location',
            'users_data',
            'ca',
            'ex',
            'luc',
            'farmer',
         ));
     }
  //CA Surplus Search part
     public function search(){

      return view('dashboard.aggregatordashboard');
     }

     public function national()
     {
      $date = Carbon::now()->format('Y-m-d');

      Transaction::where('expiryDate', '<', $date)
         ->where('status','=', 'S')
         ->update([
           'status' => 'E'
        ]);

        $producttype = ProductType::all();
        $product = Product::all();

        $farmer = User::where('role_id','9')->count();
        $ex = User::where('role_id','7')->count();
        $luc = User::where('role_id','8')->count();
        $ardc = User::where('role_id','6')->count();
        $vsc = User::where('role_id', '5')->count();
        $ca = User::where('role_id', '4')->count();
        //dd($vsc);
        return view('dashboard.nationaldashboard',compact(
           'producttype',
           'product',
           'farmer',
           'ex',
           'luc',
           'vsc',
           'ca',
           'ardc'));
    }
}
