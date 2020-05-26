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
   } elseif($role=='Head Quater' || $role =='Agriculture Research Development Center') {

      $date = Carbon::now()->format('Y-m-d');

      Transaction::where('expiryDate', '<', $date)
         ->where('status','=', 'S')
         ->update([
           'status' => 'E'
        ]);

        $producttype = ProductType::all();
        $product = Product::all();

        $area_uc = Cultivation::where('status','=', '0')->with('product')->get();
        $area_hravested = Cultivation::where('status','=', '1')->with('product','e_unit')->get();

        $last_row = EXSurplus::with('product','unit','gewog')->latest()->take(5)->get();

         $farmers = User::where('role_id','9')->count();
         $extions = User::where('role_id','7')->count();
         $luc_users = User::where('role_id','8')->count();
          $ardc = User::where('role_id','6')->count();
          $vsc = User::where('role_id', '5')->count();
          $ca_usres = User::where('role_id', '4')->count();

          //dd($vsc
          //Over all Surplus by producttype

        //EX surplus
        $veg_count=DB::table('tbl_ex_surplus')
                     ->where('productType_id','1')
                     ->SUM('quantity') ;

         $fruit_count=DB::table('tbl_ex_surplus')
               ->where('productType_id','2')
               ->SUM('quantity') ;

         $dairy_count=DB::table('tbl_ex_surplus')
               ->where('productType_id','3')
               ->SUM('quantity') ;

         $livestock_count=DB::table('tbl_ex_surplus')
               ->where('productType_id','4')
               ->SUM('quantity') ;

         $nwfp_count=DB::table('tbl_ex_surplus')
               ->where('productType_id','5')
               ->SUM('quantity');

         $maps_count=DB::table('tbl_ex_surplus')
               ->where('productType_id','6')
               ->SUM('quantity') ;

         $cereal_count=DB::table('tbl_ex_surplus')
               ->where('productType_id','7')
               ->SUM('quantity') ;

   
      //CA surplus
      $caveg_count=DB::table('tbl_cssupply')
                  ->where('productType_id','1')
                  ->SUM('quantity') ;

      $cafruit_count=DB::table('tbl_cssupply')
                  ->where('productType_id','2')
                  ->SUM('quantity') ;

      $cadairy_count=DB::table('tbl_cssupply')
                  ->where('productType_id','3')
                  ->SUM('quantity') ;

      $calivestock_count=DB::table('tbl_cssupply')
                  ->where('productType_id','4')
                  ->SUM('quantity') ;

      $canwfp_count=DB::table('tbl_cssupply')
                  ->where('productType_id','5')
                  ->SUM('quantity');

      $camaps_count=DB::table('tbl_cssupply')
                  ->where('productType_id','6')
                  ->SUM('quantity') ;

      $cacereal_count=DB::table('tbl_cssupply')
                  ->where('productType_id','7')
                  ->SUM('quantity') ;

       for($i=0;$i < 12;$i++)
                  {
            $surplus=DB::table('tbl_ex_surplus as s')
                        ->join('tbl_transactions as t', 's.refNumber', '=', 't.refNumber')
                        ->where(DB::raw('month(t.submittedDate)'), '=', $i+1)
                        ->where(DB::raw('year(t.submittedDate)'), '=', date('Y'))
                        // ->where('s.gewog_id', '=', $g)
                        ->count();
                        $casurplus_count[$i]=$surplus;
                  }


        return view('dashboard.nationaldashboard',compact(
           'producttype','product','farmers','extions','luc_users','ardc','vsc','ca_usres',
           'veg_count','fruit_count','dairy_count','livestock_count','nwfp_count','maps_count','cereal_count',
           'caveg_count','cafruit_count','cadairy_count','calivestock_count','canwfp_count','camaps_count','cacereal_count',
           'area_uc',
           'area_hravested',
           'last_row',
           'casurplus_count'
         ));
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
            'supplyProducts'
         ));
}

 elseif($role=='Gewog Extension officer' || $role=='Land User Certificate' || $role = 'Farmer Group' ) {

   $producttype = ProductType::all();
   $product = Product::all();

   //CA info
   $d=auth()->user()->dzongkhag_id;
   $user_ca = User::where('dzongkhag_id', '=', $d)
                   ->where('role_id', '=', 4)->with('dzongkhag')->get(); 
   $area_uc = Cultivation::where('status','=', '0')
                           ->where('gewog_id', '=',auth()->user()->gewog_id)->with('product')->get();
   $area_hravested = Cultivation::where('status','=', '1')
                                 ->where('gewog_id', '=',auth()->user()->gewog_id)->with('product','e_unit')->get();

   //Ex surplus              
    $g=auth()->user()->gewog_id;

      $veg_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','1')
                   ->SUM('quantity') ;

      $fruit_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','2')
                   ->SUM('quantity') ;
 
      $dairy_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','3')
                   ->SUM('quantity') ;
 
       $livestock_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','4')
                   ->SUM('quantity') ;
 
       $nwfp_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','5')
                   ->SUM('quantity');
 
       $maps_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','6')
                   ->SUM('quantity') ;
 
       $cereal_count=DB::table('tbl_ex_surplus')
                   ->where('gewog_id', '=', $g)
                   ->where('productType_id','7')
                   ->SUM('quantity');


      //    $surplus_count=DB::table('tbl_ex_surplus as s')
      //       ->join('tbl_transactions as t', 's.refNumber', '=', 't.refNumber')
      //       ->where(DB::raw('month(t.submittedDate)'), '=', date('n'))
      //       ->where('s.gewog_id', '=', $g)
      //       //->select(db::raw('month(t.submittedDate) as month'))
      //       ->count();

      for($i=0;$i < 12;$i++)
      {
            $surplus=DB::table('tbl_ex_surplus as s')
            ->join('tbl_transactions as t', 's.refNumber', '=', 't.refNumber')
            ->where(DB::raw('month(t.submittedDate)'), '=', $i+1)
            ->where(DB::raw('year(t.submittedDate)'), '=', date('Y'))
            ->where('s.gewog_id', '=', $g)
            ->count();
            $surplus_count[$i]=$surplus;
      }

     //dd($surplus_count);

        return view('dashboard.extensiondashboard',compact(
           'user_ca','producttype','product',
           'veg_count','fruit_count','dairy_count','livestock_count','nwfp_count','maps_count','cereal_count',
           'surplus_count','producttype',
           'product',
           'user_ca',
           'area_uc',
           'area_hravested'

         ));
    }
   }
}