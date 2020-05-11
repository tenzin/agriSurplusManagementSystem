<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\ProductType;
use App\EXSurplus_Transcation;
use App\EXSurplus;
use App\Product;
use App\Unit;
use Session;

class ExtensionSupplyController extends Controller
{
    
    public function __construct(Request $request) {
        
        $this->request = $request;
        $this->middleware('auth');
    }
    
    public function product_type(){

        $id = $this->request->input('product_type');
        $product=DB::table('tbl_products')
            ->where('productType_id', '=', $id)
            ->get();
        return response()->json($product);
    }

    public function ex_expriydate(){

        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_ex_surplus_transcations')
            // ->where('user_id', '=' , $user->id)
            ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->where('status', '!=', 'S')
            ->get('refNumber');

            if($checkno->isNotEmpty()){
                Session::put('NextNumber', $checkno);
                return redirect('/ex_supply_view');
            }

        return view('extension_farmer.supply.expirydate');
    }

    public function ex_store_transcation(Request $request){

        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //-----Check referance number exist
        $ref = DB::table('tbl_ex_surplus_transcations')
            //  ->where('user_id', '=' , $user->id)
             ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
             ->where('refNumber', 'Like' , '%'.$refno.'%')
             ->get();
        
        if($ref->isEmpty()){
            $number = 1;
            $number = sprintf('%05d', $number);
            $nextNumber = $type.date('Ym').$number;
            //$nextNumber = 'xxxx';
            
        } else {

        $max = EXSurplus_Transcation::where('refNumber','like', '%'.$refno.'%')->max('refNumber');
        $number = substr($max,1,12);
        $number=$number+1;
        $nextNumber = $type.$number;
        }
       
        // //------Save Referance Number---
        // $current = Carbon::now();
        // $trialExpires = $current->addDays(7);

        $data = new EXSurplus_Transcation;
        $data->refNumber = $nextNumber;
        $data->type = 'S';
        $data->expiryDate = $request->expirydate;
        $data->status = 'A';
        $data->user_id = $user->id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;
        // dd($data);
        // $refno = $data->refNumber;
        $data->save();
        $product_type= ProductType::all();
        $unit=Unit::all();
        
        return view('extension_farmer.supply.create',compact('nextNumber','product_type','unit')); 
        
        
    }
    public function index()
    { 

        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_ex_surplus_transcations')
            // ->where('user_id', '=' , $user->id)
            ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->where('status', '!=', 'S')
            ->get('refNumber');

            if($checkno->isNotEmpty()){
                Session::put('NextNumber', $checkno);
                return redirect('/ex_supply_view');
            }
        //-----Check referance number exist
        $ref = DB::table('tbl_ex_surplus_transcations')
            //  ->where('user_id', '=' , $user->id)
             ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
             ->where('refNumber', 'Like' , '%'.$refno.'%')
             ->get();
        
        if($ref->isEmpty()){
            $number = 1;
            $number = sprintf('%05d', $number);
            $nextNumber = $type.date('Ym').$number;
            //$nextNumber = 'xxxx';
            
        } else {

        $max = EXSurplus_Transcation::where('refNumber','like', '%'.$refno.'%')->max('refNumber');
        $number = substr($max,1,12);
        $number=$number+1;
        $nextNumber = $type.$number;
        }
        
        $product_type= ProductType::all();
        $unit=Unit::all();
        
        return view('extension_farmer.supply.create',compact('nextNumber','product_type','unit')); 
    }

    public function ex_supply_temp()
    {
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();
        $supply = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product')
                ->get();
        $count = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $nextNumber)
                ->count();
        return view('extension_farmer.supply.create',compact('nextNumber','product_type','unit','supply','count'));
    }


    public function ex_supply_view()
    {
        $refno =session('NextNumber');
        $refno1 = str_replace('[{"refNumber":"','',$refno);
        $refno2 = str_replace('"}]','',$refno1);
        $supply = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $refno2)
                ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                ->select('tbl_ex_surplus.tentativePickupDate','tbl_ex_surplus.harvestDate','tbl_ex_surplus.price','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product','tbl_units.unit')
                ->get();
                //return $refno;  
        return view('extension_farmer.supply.view',compact('supply','refno2'))->with('msg','Please Submit Your Surplus Information');
    }

    public function submit_ex_supply()
    {
        
        $user = auth()->user();
        $id = $this->request->input('ref_number');
        DB::table('tbl_ex_surplus_transcations')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->update(['status' => 'S']);
    }
    
    public function ex_store(Request $request)
    {
        // dd('sdbjfhs');
        $user = auth()->user();
        $request->session()->put('NextNumber', $request->input('refnumber'));
        $data = new EXSurplus;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('ut');
        $data->tentativePickupDate = $request->input('date');
        $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'R';
        $data->remarks = $request->input('remarks');
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;
        $data->save();
        return redirect('/ex_supply_temp')->with('nextNumber');
    }

    public function view_supply_details()
    {
        $product = EXSurplus::with('product','unit')->where('gewog_id', Auth::user()->gewog_id)->latest()->get();
        return view('extension_farmer.supply.supply_home',compact('product'));
    }


}
