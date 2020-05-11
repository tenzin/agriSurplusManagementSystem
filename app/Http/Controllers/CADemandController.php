<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\ProductType;
use App\Transaction;
use App\Demand;
use App\Unit;
use Session;
use Carbon\Carbon;
class CADemandController extends Controller
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
        $date = date('Ym');
        $type = "D"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
        ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
        ->where('status', '!=', 'S')
        ->where('type', '=', 'D')
        ->get('refNumber');

        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            return redirect('/demand_view');
            // return $this->demand_temp();
        }

        return view('ca_nvsc.demand.expirydate');
    }

    public function store_transcation(Request $request){

        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "D"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
    //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
        ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
        ->where('status', '!=', 'S')
        ->where('type', '=', 'D')
        ->get('refNumber');

        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            // return redirect('/demand_view');
            return $this->demand_temp();
        }
        //-----Check referance number exist
        $ref = DB::table('tbl_transactions')
            ->where('refNumber', 'Like' , '%'.$refno.'%')
            ->get();

        if($ref->isEmpty()) {
            $number = 1;
            $number = sprintf("%05d", $number);
            $nextNumber = $type.date('Ym').$number;
            

        } else {
            $max = Transaction::where('refNumber','like', '%'.$refno.'%')->max('refNumber');
            $number = substr($max,1,12);
            $number=$number+1;
            $nextNumber = $type.$number;
     // dd($nextNumber );
        }
        // dd($nextNumber );
            $expiry = $request->expirydate;
            
            //------Save Referance Number---
            $current = Carbon::now();
            $trialExpires = $current->addDays($expiry);

            $data = new Transaction;
            $data->refNumber = $nextNumber;
            $data->type = 'D';
            $data->expiryDate = $trialExpires;
            $data->status = 'A';
            $data->user_id = $user->id;
            $data->dzongkhag_id = $user->dzongkhag_id;
            $data->gewog_id = $user->gewog_id;

            $data->save();

            $product_type= ProductType::all();
            $unit=Unit::all();
        
    return view('ca_nvsc.demand.create',compact('nextNumber','product_type','unit'));
    }
    
    

    public function demand_temp()
    {
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();
        $demands = DB::table('tbl_demands')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','tbl_demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_demands.product_id', '=', 'tbl_products.id')
                ->select('tbl_demands.quantity','tbl_product_types.type','tbl_products.product', 'tbl_demands.price',
                'tbl_demands.id')
                ->get();
        $counts = DB::table('tbl_demands')
                ->where('refNumber', '=', $nextNumber)
                ->count();
        return view('ca_nvsc.demand.create',compact('nextNumber','product_type','unit','demands','counts'));
    }


    public function demand_view()
    {
        $refno =session('NextNumber');
        $refno1 = str_replace('[{"refNumber":"','',$refno);
        $refno2 = str_replace('"}]','',$refno1);
        $demand = DB::table('tbl_demands')
                ->where('refNumber', '=', $refno2)
                ->join('tbl_product_types','tbl_demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_demands.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_demands.unit_id', '=', 'tbl_units.id')
                ->select('tbl_demands.tentativeRequiredDate','tbl_demands.price','tbl_demands.quantity','tbl_product_types.type','tbl_products.product','tbl_units.unit','tbl_demands.id')
                ->get();
                // dd($demand);
                //return $refno;  
        return view('ca_nvsc.demand.view',compact('demand','refno2'))->with('msg','Your demand(s) not submitted');
    }

    public function submit_demand()
    {

        $user = auth()->user();
        $id = $this->request->input('ref_number');
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->update(['status' => 'S']);
    }
    
    public function store(Request $request)
    {
        $request->session()->put('NextNumber', $request->input('refnumber'));
        
        $data = new Demand;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('ut');
        $data->tentativeRequiredDate = $request->input('date');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('/demand_temp')->with('nextNumber');
    }

    public function edit($id)
    {
        
        $nextNumber =session('NextNumber');
        $individual = Demand::find($id);
        
        $demand = DB::table('tbl_demands')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','tbl_demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_demands.product_id', '=', 'tbl_products.id')
                ->select('tbl_demands.quantity','tbl_product_types.type','tbl_products.product', 'tbl_demands.price',
                'tbl_demands.id')
                ->get();
        $count = DB::table('tbl_demands')
                ->where('refNumber', '=', $nextNumber)
                ->count();
                
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        //return $unit;
        return view('ca_nvsc.demand.edit')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('nextNumber',$nextNumber)
                                ->with('demands',$demand)
                                ->with('counts',$count)
                                ->with('individuals',$individual)
                                ->with('produce',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $this->validate($request,[
        //     'product' =>'required',
        //     'producttype' =>'required',
        //     'price' =>'required',
        //     'unit' =>'required',
        //     'date' =>'required'

        // ]);
        $data = Demand::find($request->id);
        
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->tentativeRequiredDate = $request->input('date');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('demanded-view')->with('msg','Saved successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity= Demand::find($id);
        $activity->delete();
        return redirect()->back()->with('msg','Deleted successfully!!');
    }

    public function view_surplus_demand_details()
    {
        $demand = Demand::with('product','unit')->where('dzongkhag_id', Auth::user()->dzongkhag_id)->latest()->get();
        return view('ca_nvsc.demand.surplus_demand_home',compact('demand'));
    }
}

