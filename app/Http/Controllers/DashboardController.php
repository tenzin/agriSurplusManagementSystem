<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductType;
use App\User;
use App\Transaction;
use App\EXSurplus;
use App\Dzongkhag;
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
//EX surplus view
  public function view($id){

      $user=auth()->user();
      $supplyProducts = EXSurplus::find($id);
   return view('dashboard.exsurplusview',compact('supplyProducts'));
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
           'farmers', 'extions', 'luc_users', 'ardc', 'vsc', 'ca_usres'));
  

     // $this->adminDashboard();
   } elseif($role=='Headquarter' || $role =='Agriculture Research Development Center' ) {

     

        $producttype = ProductType::all();
        $product = Product::all();

        $area_uc = Cultivation::where('status','=', '0')->with('product','c_unit')->get();
        $area_hravested = Cultivation::where('status','=', '1')->with('product','e_unit')->get();

        $last_row = EXSurplus::with('product','unit','gewog')->where('quantity','>',0)->latest()->take(5)->get();

         $farmers = User::where('role_id','9')->count();
         $extions = User::where('role_id','7')->count();
         $luc_users = User::where('role_id','8')->count();
         $ardc = User::where('role_id','6')->count();
         $vsc = User::where('role_id', '5')->count();
         $ca_usres = User::where('role_id', '4')->count();

         
        
          //Over all Surplus by producttype
         $surplustemp = DB::statement("CREATE TEMPORARY TABLE IF NOT EXISTS tmpSurplus(
                        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        trans_id int(12),
                        refNumber varchar(50),
                        productType_id varchar(5),
                        product_id varchar(10),
                        quantity float(10),
                        submittedDate  DATE
           )");
          //INSERT INTO tmpSurplus

           $sqlex="INSERT INTO tmpSurplus(refNumber,trans_id,productType_id,product_id,quantity,submittedDate) 
                  select tbl_ex_surplus.refNumber,tbl_transactions.id,productType_id,product_id,quantity,submittedDate from tbl_ex_surplus
                  join tbl_transactions on tbl_transactions.id = tbl_ex_surplus.trans_id";
               //   dd($sqlex);

           DB::statement($sqlex);

           $sqlca="INSERT INTO tmpSurplus(refNumber,trans_id,productType_id,product_id,quantity,submittedDate) 
           select tbl_cssupply.refNumber,tbl_transactions.id,productType_id,product_id,quantity,submittedDate from tbl_cssupply
           join tbl_transactions on tbl_transactions.id = tbl_cssupply.trans_id";
           // dd($sqlca);
           DB::statement($sqlca);

          $allveg_count=DB::table('tmpSurplus')
                  ->where('productType_id','=',1)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->join('tbl_transactions','tmpSurplus.trans_id','=','tbl_transactions.id')
                  ->SUM('quantity');
              // dd($allveg_count);

          $allfruit_count=DB::table('tmpSurplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tmpSurplus.trans_id')
                  ->where('productType_id','=',2)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->SUM('quantity');

          $alldairy_count=DB::table('tmpSurplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tmpSurplus.trans_id')
                  ->where('productType_id','=',3)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->SUM('quantity');

          $alllivestock_count=DB::table('tmpSurplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tmpSurplus.trans_id')
                  ->where('productType_id','=',4)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->SUM('quantity');

         $allnwfp_count=DB::table('tmpSurplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tmpSurplus.trans_id')
                  ->where('productType_id','=',5)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->SUM('quantity');

        $allmaps_count=DB::table('tmpSurplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tmpSurplus.trans_id')
                  ->where('productType_id','=',6)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->SUM('quantity');

       $allcereal_count=DB::table('tmpSurplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tmpSurplus.trans_id')
                  ->where('productType_id','=',7)
                  ->where('tbl_transactions.status','=','S')
                  ->where(DB::raw('month(tbl_transactions.submittedDate)'), '=',date('n'))
                  ->SUM('quantity');
                  
        DB::statement("DROP TEMPORARY TABLE IF EXISTS tmpSurplus"); 



      //EX surplus
        $veg_count=DB::table('tbl_ex_surplus')
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',1)
                   ->where('tbl_transactions.status','S')
                   ->SUM('quantity') ;

         $fruit_count=DB::table('tbl_ex_surplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                  ->where('productType_id',2)
                  ->where('tbl_transactions.status','S')
                  ->SUM('quantity') ;


         $dairy_count=DB::table('tbl_ex_surplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                  ->where('productType_id',3)
                  ->where('tbl_transactions.status','S')
                  ->SUM('quantity') ;

         $livestock_count=DB::table('tbl_ex_surplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                  ->where('productType_id',4)
                  ->where('tbl_transactions.status','S')
                  ->SUM('quantity') ;

         $nwfp_count=DB::table('tbl_ex_surplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                  ->where('productType_id',5)
                  ->where('tbl_transactions.status','S')
                  ->SUM('quantity') ;

         $maps_count=DB::table('tbl_ex_surplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                  ->where('productType_id',6)
                  ->where('tbl_transactions.status','S')
                  ->SUM('quantity') ;

         $cereal_count=DB::table('tbl_ex_surplus')
                  ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                  ->where('productType_id',7)
                  ->where('tbl_transactions.status','S')
                  ->SUM('quantity') ;
   
      //CA surplus
            $caveg_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',1)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

            $cafruit_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',2)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

            $cadairy_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',3)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

            $calivestock_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',4)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

            $canwfp_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',5)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

            $camaps_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',6)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

            $cacereal_count=DB::table('tbl_cssupply')
                              ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                              ->where('productType_id',7)
                              ->where('tbl_transactions.status','S')
                              ->SUM('quantity') ;

              for($i=0;$i < 12;$i++){
                    $surplus=DB::table('tbl_ex_surplus as s')
                              ->join('tbl_transactions as t', 's.refNumber', '=', 't.refNumber')
                              ->where(DB::raw('month(t.submittedDate)'), '=', $i+1)
                              ->where(DB::raw('year(t.submittedDate)'), '=', date('Y'))
                              ->count();
                    $casurplus_count[$i]=$surplus;
                   }

            return view('dashboard.nationaldashboard',compact(
            'producttype','product','farmers','extions','luc_users','ardc','vsc','ca_usres',
            'veg_count','fruit_count','dairy_count','livestock_count','nwfp_count','maps_count','cereal_count',
            'caveg_count','cafruit_count','cadairy_count','calivestock_count','canwfp_count','camaps_count','cacereal_count',
            'area_uc', 'area_hravested', 'last_row', 'casurplus_count',
            'allveg_count','allfruit_count','alllivestock_count','allnwfp_count','allmaps_count','allcereal_count',
            'alldairy_count'
            ));
     }

     
elseif($role=='Commercial Aggregator' || $role=='Vegetable Supply Company' ) {

      $date = Carbon::now()->format('Y-m-d');

      Transaction::where('expiryDate', '<', $date)
         ->where('status','=', 'S')
         ->update([
           'status' => 'E'
        ]);
        
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

            $supplyProducts = EXSurplus::search($request)->where('quantity','>',0)->with('product','dzongkhag','gewog')->get();
            
        }
        return view('dashboard.aggregatordashboard',compact(
            'product','producttype','location','users_data','ca','ex','luc','farmer','supplyProducts'
         ));
}

 elseif($role=='Gewog Extension officer' || $role=='Land User Certificate' || $role == 'Farmer Group' ) {


      $date = Carbon::now()->format('Y-m-d');

      Transaction::where('expiryDate', '<', $date)
         ->where('status','=', 'S')
         ->update([
           'status' => 'E'
        ]);

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
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',1)
                   ->where('tbl_transactions.status','S')
                   ->SUM('quantity') ;

      $fruit_count=DB::table('tbl_ex_surplus')
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',2)
                   ->where('tbl_transactions.status','S')
                      ->SUM('quantity') ;
 
      $dairy_count=DB::table('tbl_ex_surplus')
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',3)
                   ->where('tbl_transactions.status','S')
                      ->SUM('quantity') ;
 
       $livestock_count=DB::table('tbl_ex_surplus')
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',4)
                   ->where('tbl_transactions.status','S')
                   ->SUM('quantity') ;
 
       $nwfp_count=DB::table('tbl_ex_surplus')
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',5)
                   ->where('tbl_transactions.status','S')
                   ->SUM('quantity');
 
       $maps_count=DB::table('tbl_ex_surplus')
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',6)
                   ->where('tbl_transactions.status','S')
                   ->SUM('quantity') ;
 
       $cereal_count=DB::table('tbl_ex_surplus')
                   ->where('tbl_ex_surplus.gewog_id', '=', $g)
                   ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                   ->where('productType_id',7)
                   ->where('tbl_transactions.status','S')
                   ->SUM('quantity');

      for($i=0;$i < 12;$i++)
      {
            $surplus=DB::table('tbl_ex_surplus as s')
            ->join('tbl_transactions as t', 's.refNumber', '=', 't.refNumber')
            ->where(DB::raw('month(t.submittedDate)'), '=', $i+1)
            ->where(DB::raw('year(t.submittedDate)'), '=', date('Y'))
            ->where('s.gewog_id', '=', $g)
            ->where('t.status','S')
            ->count();
            $surplus_count[$i]=$surplus;
      }

     //dd($surplus_count);

        return view('dashboard.extensiondashboard',compact(
           'user_ca','producttype','product',
           'veg_count','fruit_count','dairy_count','livestock_count','nwfp_count','maps_count','cereal_count',
           'surplus_count','producttype', 'product',  'user_ca', 'area_uc','area_hravested'

         ));
    }
  
  
    elseif( $role=='Dzongkhag Agriculture Officer'){
          
            $d=auth()->user()->dzongkhag_id;
            
            $causer = User::where('dzongkhag_id', '=', $d)
                           ->where('role_id', '=', 4)->get(); 
            $exuser = User::where('dzongkhag_id', '=', $d)
                           ->where('role_id', '=', 7)->get(); 

            $farmersgroup = User::where('dzongkhag_id', '=', $d)
                           ->where('role_id','9')->get();

            $landusers = User::where('dzongkhag_id', '=', $d)
                     ->where('role_id','8')->get();

            $farmer = User::where('dzongkhag_id', '=', $d)
                     ->where('role_id','9')->count();
            $ex = User::where('dzongkhag_id', '=', $d)
                     ->where('role_id','7')->count();
            $luc = User::where('dzongkhag_id', '=', $d)
                     ->where('role_id','8')->count();
            $ca = User::where('dzongkhag_id', '=', $d)->where('role_id', '4')->count();
      
         return view('dashboard.daodashboard',compact('causer','exuser','farmer','ex','luc','ca','farmersgroup','landusers'));
    }
  }
}