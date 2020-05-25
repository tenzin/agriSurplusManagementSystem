<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductType;
use App\User;
use App\Transaction;
use App\EXSurplus;
use DB;
use App\Cultivation;
use Carbon\Carbon;

class DashboardController extends Controller
{

   public function __construct()
  {
      $this->middleware('auth');
      $this->user = \Auth::user();
  }

  public function index(Request $request) {

   $role = \Auth::user()->role->role;

   // dd($role);

   if($role=='Super Admin') {

        $farmers = User::where('role_id','9')->count();
        $extions = User::where('role_id','7')->count();
        $luc_users = User::where('role_id','8')->count();
        $ardc = User::where('role_id','6')->count();
        $vsc = User::where('role_id', '5')->count();
        $ca_usres= User::where('role_id', '4')->count();
        //dd($vsc);
        return view('dashboard.admindashboard',compact(
           'farmers',
           'extions',
           'luc_users',
           'ardc',
           'vsc',
           'ca_usres'));
  

     // $this->adminDashboard();
   } elseif($role=='Head Quater' || $role=='Agriculture Research Development Center') {

      $date = Carbon::now()->format('Y-m-d');

      Transaction::where('expiryDate', '<', $date)
         ->where('status','=', 'S')
         ->update([
           'status' => 'E'
        ]);

        $producttype = ProductType::all();
        $product = Product::all();

        $farmers = User::where('role_id','9')->count();
        $extions = User::where('role_id','7')->count();
        $luc_users = User::where('role_id','8')->count();
        $ardc = User::where('role_id','6')->count();
        $vsc = User::where('role_id', '5')->count();
        $ca_usres= User::where('role_id', '4')->count();

        $area_uc = Cultivation::where('status','=', '0')->with('product')->get();
        $area_hravested = Cultivation::where('status','=', '1')->with('product','e_unit')->get();

        $last_row = EXSurplus::with('product','unit','gewog')->latest()->take(5)->get();

      //   dd($last_row);
      
        return view('dashboard.nationaldashboard',compact(
           'producttype',
           'product',
           'farmers',
           'extions',
           'luc_users',
           'ardc',
           'vsc',
           'ca_usres',
           'area_uc',
           'area_hravested',
           'last_row'));
   }
elseif($role=='Commercial Aggregator' || $role=='Vegetable Supply Company' ) {

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
         
         $supplyProducts = [];
      
         if ($request->query('crop') && $request->has('crop')){

            $supplyProducts = EXSurplus::search($request)->with('product','dzongkhag','gewog','transaction')->get();
            
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

 elseif($role=='Gewog Extension officer' || $role=='Land User Certificate' || $role = 'Farmer Group' ) {

   $d=auth()->user()->dzongkhag_id;

   $producttype = ProductType::all();
   $product = Product::all();

   $user_ca = User::where('dzongkhag_id', '=', $d)
                   ->where('role_id', '=', 4)->with('dzongkhag')->get(); 
   $area_uc = Cultivation::where('status','=', '0')
                           ->where('gewog_id', '=',auth()->user()->gewog_id)->with('product')->get();
   $area_hravested = Cultivation::where('status','=', '1')
                                 ->where('gewog_id', '=',auth()->user()->gewog_id)->with('product','e_unit')->get();

   // dd($area_uc);
    return view('dashboard.extensiondashboard',compact(
       'producttype',
       'product',
       'user_ca',
       'area_uc',
       'area_hravested'
     ));
 }
}
}

