<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductType;
use App\User;
use App\Transaction;
use App\EXSurplus;

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
      $d=auth()->user()->dzongkhag_id;

       $producttype = ProductType::all();
       $product = Product::all();

       $user_ca = User::where('dzongkhag_id', '=', $d)
                       ->where('role_id', '=', 4)->with('dzongkhag')->get(); 
   
        return view('dashboard.extensiondashboard',compact(
           'producttype',
           'product',
           'user_ca'
         ));
     }

     public function aggregator(Request $request)
     {

      $d=auth()->user()->dzongkhag_id;
      $user = Auth()->user();
      $product = Product::all();
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

      //  $product_type = $request->type;
      //  dd($producttype);

      //  $pro =DB::table('tbl_ex_surplus')
      //        ->where('tbl_ex_surplus.productType_id','=',$product_type)
      //        ->select('tbl_ex_surplus.product_id','tbl_transactions.dzongkhag_id','tbl_transactions.gewog_id','tbl_transactions.submittedDate')
      //        ->join('tbl_transactions','tbl_ex_surplus.refNumber','=','tbl_transactions.refNumber')
      //        ->join('tbl_product_types','tbl_ex_surplus.productType_id','=','tbl_product_types.id')->get();
         
         $supplyProducts = [];
      //   if ($request->query('crop') && $request->has('crop') || $request->query('location') && $request->has('location')) {
         if ($request->query('crop') && $request->has('crop')){

            $supplyProducts = EXSurplus::search($request)->with('product','dzongkhag','gewog','transaction')->get();
            // dd($supplyProducts);
            // $demandProducts = Transaction::search($request)->with('product')->get();
        }
        return view('dashboard.aggregatordashboard',compact(
            'product',
            'producttype',
            'location',
            'users_data',  
            'ca',
            'ex',
            'luc',
            'farmer',
            'supplyProducts',
         ));
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
