<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\ProductType;
use App\Transaction;
use App\CASupply;
use App\Unit;
use Session;
use Carbon\Carbon;

class CASurplusController extends Controller
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

    public function expriydate(){

        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
            ->where('user_id', '=' , $user->id)
            // ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->where('type', '=', 'S')
            ->where('status', '!=', 'S')
            ->get('refNumber');

            if($checkno->isNotEmpty()){
                $refno1 = str_replace('[{"refNumber":"','',$checkno);
                $refno2 = str_replace('"}]','',$refno1);
                Session::put('NextNumber', $refno2);
                return redirect('/supply_view');
            }

        return view('ca_nvsc.surplus.expirydate');
    }

    public function ex_store_transcation(Request $request){

        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        // ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
        ->where('type', '=', 'S')
        ->where('status', '!=', 'S')
        ->get('refNumber');

        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            // return redirect('/demand_view');
            return $this->supply_temp();
        }
        //-----Check referance number exist
        $ref = DB::table('tbl_transactions')
             ->where('user_id', '=' , $user->id)
            //  ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
             ->where('type', '=', 'S')
             ->where('refNumber', 'Like' , '%'.$refno.'%')
             ->get();
        
        if($ref->isEmpty()){
            $number = 1;
            $number = sprintf('%05d', $number);
            $nextNumber = $type.date('Ym').$number;
            //$nextNumber = 'xxxx';
            
        } else {

        $max = Transaction::where('refNumber','like', '%'.$refno.'%')->max('refNumber');
        $number = substr($max,1,12);
        $number=$number+1;
        $nextNumber = $type.$number;
        }
       
        $expiry = $request->expirydate;
            
            //------Save Referance Number---
            $current = Carbon::now();
            $trialExpires = $current->addDays($expiry);

        $data = new Transaction;
        $data->refNumber = $nextNumber;
        $data->type = 'S';
        $data->expiryDate = $trialExpires;
        $data->status = 'A';
        $data->user_id = $user->id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;
        // $refno = $data->refNumber;
        $data->save();
        $product_type= ProductType::all();
        $unit=Unit::all();
        
        return view('ca_nvsc.surplus.create',compact('nextNumber','product_type','unit')); 
        
    }
    

    public function supply_temp()
    {
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();
        $supply = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id')
                ->get();
        $counts = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $nextNumber)
                ->count();
        return view('ca_nvsc.surplus.create',compact('nextNumber','product_type','unit','supply','counts'));
    }


    public function ca_supply_view()
    {
        $refno =session('NextNumber');
        $refno1 = str_replace('[{"refNumber":"','',$refno);
        $refno2 = str_replace('"}]','',$refno1);
        $supply = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $refno2)
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                ->select('tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate','tbl_cssupply.price','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product','tbl_units.unit','tbl_cssupply.id')
                ->get();
                //return $refno;  
        return view('ca_nvsc.surplus.view',compact('supply','refno2'))->with('msg','Please Submit Your Surplus Information');
    }

    public function submit_ca_suuply()
    {

        $user = auth()->user();
        $id = $this->request->input('ref_number');
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->update(['status' => 'S']);
    }
    
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->session()->put('NextNumber', $request->input('refnumber'));
        $data = new CASupply;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('ut');
        $data->tentativePickupDate = $request->input('date');
        $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->save();
        return redirect('/supply_temp')->with('nextNumber');
    }

    public function edit($id)
    {
        
        $nextNumber =session('NextNumber');
        $individual = CASupply::find($id);
        
        $supply = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id')
                ->get();
        $count = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $nextNumber)
                ->count();
                
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        //return $unit;
        return view('ca_nvsc.surplus.edit')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('nextNumber',$nextNumber)
                                ->with('supplys',$supply)
                                ->with('counts',$count)
                                ->with('individuals',$individual)
                                ->with('produce',$product);
    }

    public function update(Request $request)
    {
        // $this->validate($request,[
        //     'product' =>'required',
        //     'producttype' =>'required',
        //     'price' =>'required',
        //     'unit' =>'required',
        //     'date' =>'required'

        // ]);
        $data = CASupply::find($request->id);
        
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->tentativePickupDate = $request->input('date');
        $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('ca-view')->with('msg','Saved successfully!!');
    }

    public function ca_destroy($id)
    {
        $activity= CASupply::find($id);
        $activity->delete();
        return redirect()->back()->with('msg','Deleted successfully!!');
    }
   
    public function view_surplus_details(){
        
        $product = CASupply::with('product','unit')->where('dzongkhag_id', Auth::user()->dzongkhag_id)->latest()->get();
        return view('ca_nvsc.surplus.surplus_home',compact('product'));
    }


}


