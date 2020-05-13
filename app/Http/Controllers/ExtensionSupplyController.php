<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\ProductType;
use App\Transaction;
use App\EXSurplus;
use App\Product;
use App\Unit;
use Session;
use Carbon\Carbon;


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
    public function surplus_exists(){
        $id = $this->request->input('refNo');
        $data=DB::table('tbl_ex_surplus')
            ->where('refNumber', '=', $id)
            ->get();
        if ($data->isEmpty()) {
            return null;
         } else {
            return response()->json($id);
         }
        
        // $data = DB::table('demands')
        //     ->where('refNumber','=', $id)->get('refNmuber');
        // return response()->json($data);
    }

    public function ex_expiryday(){

        $user = auth()->user();
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
            ->where('user_id', '=' , $user->id)
            ->where('status', '!=', 'S')
            ->where('type', '=', 'S')
            ->get('refNumber');

            if($checkno->isNotEmpty()){
                $refno1 = str_replace('[{"refNumber":"','',$checkno);
                $refno2 = str_replace('"}]','',$refno1);
                Session::put('NextNumber', $refno2);
                return redirect('/ex_supply_view');
            }

        return view('extension_farmer.supply.expiryday');
    }

    public function ex_store_transaction(Request $request){

        $user = auth()->user();
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

    //Check transaction not submitted

        $checkno = DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '!=', 'S')
        ->where('type', '=', 'S')
        ->get('refNumber');

        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            return $this->ex_supply_temp();
        }

        //Check referance number exist

        $ref = DB::table('tbl_transactions')
            ->where('user_id', '=' , $user->id)
            ->where('type', '=', 'S')
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
        }

           // dd($nextNumber );

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

            $data->save();

            $product_type= ProductType::all();
            $unit=Unit::all();
    
            return view('extension_farmer.supply.create',compact('nextNumber','product_type','unit'));
    }

    public function ex_store(Request $request)
    {
        $user = auth()->user();
        $request->session()->put('NextNumber', $request->input('refnumber'));
        $data = new EXSurplus;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->tentativePickupDate = $request->input('pickupdate');
        $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'A';//Active=A
        $data->remarks = $request->input('remarks');
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;
        $data->save();
        return redirect('/ex_supply_temp')->with('nextNumber');
    }
//show 
public function show_submit()
{
    $user = auth()->user();
    $date = date('Ym');
    $type = "S"; //Transaction type D: Demand; S: Supply
    $refno = $type.$date;

    //--------Check transaction not submitted
    $checkno = DB::table('transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '=', 'S')
        ->where('type', '=', 'S')
        ->get();
        foreach($checkno as $data){
            $ref = array(
                $data->refNumber,
            );
        }
    $surplus = DB::table('tbl_ex_surplus')
            ->where('transactions.user_id', '=', $user->id)
            ->where('transactions.status', '=', 'S')
            ->where('transactions.type', '=', 'D')
            ->join('transactions','tbl_ex_surplus.refNumber', '=', 'transactions.refNumber')
            ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
            ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
            ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
            ->select('tbl_ex_surplus.refNumber','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
            'tbl_ex_surplus.id', 'tbl_units.unit', 'tbl_ex_surplus.tentativeRequiredDate',)
            ->get();
    Session::put('View_status', 'VS');
    return view('extension_farmer.supply.view')->with('tbl_ex_surplus',$surplus)
                            ->with('msg','Submitted Product List.');
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
                ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                'tbl_ex_surplus.id')
                ->get();
        $count = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $nextNumber)
                ->count();
        return view('extension_farmer.supply.create',compact('nextNumber','product_type','unit','supply','count'));
    }

    public function ex_edit($id)
    {
        
        $nextNumber =session('NextNumber');
        $individual = EXSurplus::find($id);
        
        $surplus = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                'tbl_ex_surplus.id')
                ->get();
        $count = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $nextNumber)
                ->count();
                
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        return view('extension_farmer.supply.edit')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('nextNumber',$nextNumber)
                                ->with('supplys',$surplus)
                                ->with('counts',$count)
                                ->with('individuals',$individual)
                                ->with('produce',$product);
    }


    public function ex_update(Request $request)
    {
        // $this->validate($request,[
        //     'product' =>'required',
        //     'producttype' =>'required',
        //     'price' =>'required',
        //     'unit' =>'required',
        //     'date' =>'required'

        // ]);
        $data = EXSurplus::find($request->id);
        
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->harvestDate = $request->input('date');
        $data->tentativePickupDate = $request->input('date');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();
        if(session('View_status')=='V'){
            return redirect('surplus-view')->with('msg','Saved successfully!!');
        }else
        return redirect('/ex_supply_temp')->with('msg','Saved successfully!!');
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
                ->select('tbl_ex_surplus.tentativePickupDate','tbl_ex_surplus.harvestDate','tbl_ex_surplus.price','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product','tbl_units.unit','tbl_ex_surplus.id')
                ->get();
                //return $refno;  
        return view('extension_farmer.supply.view',compact('supply','refno2'))->with('msg','Please Submit Your Surplus Information');
    }

    public function ex_submit_supply()
    {
        
        $user = auth()->user();
        $id = $this->request->input('ref_number');
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->update(['status' => 'S']);
    }
    
    public function destroy($id)
    {
        $activity= ExSurplus::find($id);
        $activity->delete();
        return redirect()->back()->with('msg','Deleted successfully!!');
    }
    
    public function view_supply_details()
    {
        $product = EXSurplus::with('product','unit')->where('gewog_id', Auth::user()->gewog_id)->latest()->get();
        return view('extension_farmer.supply.supply_home',compact('product'));
    }

    //view individual
    public function ex_view_detail($id){

        $row = EXSurplus::find($id);
        return view('extension_farmer.supply.surplusview', compact('row'));
    }

    public function edit_submitted($id)
    {      
        $demand = DB::table('tbl_ex_surplus')
              //->where('demands.id', '=', $id)
                ->where('tbl_ex_surplus.id','=', $id)
                ->get(); 
                //return $demand; 
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        //return $unit;
        return view('extension_farmer.supply.edit-submitted')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('demands',$demand)
                                ->with('produce',$product);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'product' =>'required',
            'producttype' =>'required',
            'price' =>'required',
            'unit' =>'required',
            'date' =>'required'

        ]);
        $data = Demand::find($id);
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->tentativeRequiredDate = $request->input('date');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();
        if(session('View_status')=='V'){
            return redirect('/demand/show')->with('msg','Saved successfully!!');
        } else {
            return redirect('/demand_temp')->with('msg','Saved successfully!!');
        }
        
    }


}
