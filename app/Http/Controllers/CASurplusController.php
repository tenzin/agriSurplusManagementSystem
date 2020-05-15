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

    public function ca_product_exists()
    {
        $id = $this->request->input('refNo');
        $data=DB::table('tbl_cssupply')
            ->where('refNumber', '=', $id)
            ->get();
        if ($data->isEmpty()) {
            return null;
         } else {
            return response()->json($id);
         }
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

            //remove unnecessary character
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
                $refno2 = str_replace('"}]','',$refno1);

                $list = CASupply::where('refNumber', '=', $refno2)->first();
                if($checkno->isNotEmpty() && $list!=''){
                    
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
                    ->where('status', '!=', 'E')
                    ->get('refNumber');

        // dd($checkno);
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
        
        Session::put('View_status', 'A');
        return view('ca_nvsc.surplus.create',compact('nextNumber','product_type','unit')); 
        
    }
    

    public function supply_temp()
    {
        $user = auth()->user();
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();
        $supply = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $nextNumber)
                ->where('dzongkhag_id', '=', $user->dzongkhag_id)
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id')
                ->get();
        $counts = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $nextNumber)
                ->where('dzongkhag_id', '=', $user->dzongkhag_id)
                ->count();

                Session::put('View_status', 'E');
        return view('ca_nvsc.surplus.create',compact('nextNumber','product_type','unit','supply','counts'));
    }


    public function ca_supply_view()
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno =session('NextNumber');
        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '!=', 'S')
        ->where('status', '!=', 'E')
        ->where('type', '=', 'S')
        ->get('refNumber');
        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
        }
        $supply = DB::table('tbl_cssupply')
                ->where('refNumber', '=', $refno2)
                ->where('dzongkhag_id', '=', $user->dzongkhag_id)
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id', 'tbl_units.unit', 'tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate')
                ->paginate(15);
        Session::put('View_status', 'V');
        return view('ca_nvsc.surplus.view')->with('supply',$supply)
                                ->with('nextNumber',$refno2)
                                ->with('msg','Your demand(s) not submitted');

        // $refno =session('NextNumber');
        // $refno1 = str_replace('[{"refNumber":"','',$refno);
        // $refno2 = str_replace('"}]','',$refno1);
        // $supply = DB::table('tbl_cssupply')
        //         ->where('refNumber', '=', $refno2)
        //         ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
        //         ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
        //         ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
        //         ->select('tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate','tbl_cssupply.price','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product','tbl_units.unit','tbl_cssupply.id')
        //         ->get();
        //         //return $refno;  
        // return view('ca_nvsc.surplus.view',compact('supply','refno2'))->with('msg','Please Submit Your Surplus Information');
    }

    public function submit_ca_suuply()
    {

        $user = auth()->user();
        $id = $this->request->input('ref_number');
        $current = Carbon::now();
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->update([
                'status' => 'S',
                'submittedDate' => $current
            ]);
        
    }

    public function show($id)
    {
        $data = DB::table('tbl_cssupply')
                ->where('tbl_cssupply.refNumber', '=', $id)
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id','tbl_units.unit')
                ->get();
        return view('ca_nvsc.surplus.view-history-list')->with('supply',$data);
    }

    public function show_history()
    {
        // dd('dg');
        $user = auth()->user();
        $data = DB::table('tbl_transactions')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'S')
                ->where('status', '=', 'E')
                ->orderBy('submittedDate','DESC')
                ->paginate(15);
        return view('ca_nvsc.surplus.view-history')->with('supply',$data)
                                ->with('msg','Your demand history');
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

    public function edit_submitted($id)

    {      
        $supply = DB::table('tbl_cssupply')
                ->where('tbl_cssupply.id', '=', $id)
                ->orderBy('product_id')->get(); 
                //return $demand; 
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        //return $unit;
        return view('ca_nvsc.surplus.edit-submitted')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('supply',$supply)
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
        if(session('View_status')=='V'){

            return redirect('/supply_view')->with('msg','Saved successfully!!');
        } else {
            return redirect('/supply_temp')->with('msg','Saved successfully!!');
        }

        // return redirect('ca-view')->with('msg','Saved successfully!!');
    }

    public function update_submitted(Request $request, $id)
    {
        $qty=floatval($request->input('hqty')) -floatval($request->input('quantity'));
        if($request->input('status') =='T'){
            
            DB::table('tbl_history_ca_supply')->insert([
                'refNumber' => $request->input('refno'),
                'productType_id' => $request->input('producttype'),
                'product_id' => $request->input('product'),
                'quantity' => $request->input('quantity'),
                'unit_id' =>$request->input('unit'),
                'price' => $request->input('price'),
                'tentativePickupDate' => $request->input('date'),
                'harvestDate' => $request->input('harvestdate'),
                'status' => $request->input('status')
            ]);
        }

        $data = CASupply::find($id);
        $data->quantity = $qty;
        $data->unit_id = $request->input('unit');
        $data->price = $request->input('price');
        $data->status = $request->input('status');
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('view_surplus_details')->with('msg','Saved successfully!!');

        
    }

    public function ca_destroy($id)
    {
        $data= CASupply::find($id);
        $data->delete();
        if(session('View_status')=='V'){
            return redirect('/supply_view')->with('msg','Deleted successfully!!');
        } else {
            return redirect()->back()->with('msg','Deleted successfully!!');
        }
    }
    
    public function view_surplus_details()
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
            ->where('user_id', '=' , $user->id)
            ->where('status', '=', 'S')
            ->Where('status', '!=', 'E')
            ->where('type', '=', 'S')
            ->get();
            foreach($checkno as $data){
                $ref = array(
                    $data->refNumber,
                );
            }
        if($user->role_id==4 || $user->role_id==5){
        $supply = DB::table('tbl_cssupply')
                ->where('tbl_transactions.user_id', '=', $user->id)
                ->where('tbl_transactions.status', '=', 'S')
                ->where('tbl_transactions.type', '=', 'S')
                ->where('tbl_cssupply.dzongkhag_id', '=', $user->dzongkhag_id)
                ->where('tbl_cssupply.quantity','>',0)
                ->join('tbl_transactions','tbl_cssupply.refNumber', '=', 'tbl_transactions.refNumber')
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                ->select('tbl_cssupply.refNumber','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id', 'tbl_units.unit', 'tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate')
                ->get();
            } else {
                $supply = DB::table('tbl_cssupply')
                //->where('tbl_transactions.user_id', '=', $user->id)
                ->where('tbl_transactions.status', '=', 'S')
                ->where('tbl_transactions.type', '=', 'S')
                //->where('tbl_cssupply.dzongkhag_id', '=', $user->dzongkhag_id)
                ->where('tbl_cssupply.quantity','>',0)
                ->join('tbl_transactions','tbl_cssupply.refNumber', '=', 'tbl_transactions.refNumber')
                ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                ->select('tbl_cssupply.refNumber','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                'tbl_cssupply.id', 'tbl_units.unit', 'tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate')
                ->get();
            }

        Session::put('View_status', 'VS');
        return view('ca_nvsc.surplus.view-submitted')->with('supply',$supply)
                                ->with('msg','Submitted product list.');
        
        // $product = CASupply::with('product','unit')->where('dzongkhag_id', Auth::user()->dzongkhag_id)->latest()->get();
        // return view('ca_nvsc.surplus.surplus_home',compact('product'));
    }


    public function view_detail($id){

        $user = auth()->user();

        
        $row = CASupply::findorfail($id);

        $table = DB::table('tbl_transactions')
        ->where('tbl_transactions.user_id', '=', $user->id)
        ->join('users','tbl_transactions.user_id', '=','users.id')
        ->groupBy('users.id')
        ->select('users.contact_number')->get();
        //return $table;
        // dd($table);
        // $rows = Demand::with('dzongkhag')->get();
        return view('ca_nvsc.surplus.view-details', compact('row','table'));
    }

    public function view_surplus_nation_all()
    {
        
        // dd($location );
        $supply = DB::table('tbl_cssupply')
        // ->where('tbl_transactions.user_id', '=', $user->id)
        ->where('tbl_transactions.status', '=', 'S')
        // ->where('tbl_transactions.type', '=', 'S')
        // ->where('tbl_cssupply.tentativePickupDate', '=', $start)
        ->where('tbl_cssupply.quantity','>',0)
        ->join('tbl_transactions','tbl_cssupply.refNumber', '=', 'tbl_transactions.refNumber')
        ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
        ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
        ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
        ->select('tbl_cssupply.refNumber','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
        'tbl_cssupply.id', 'tbl_units.unit', 'tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate')
        ->groupBy('id')->paginate(10);
        // $supply = [];
        
        // if ($request->query('date') && $request->has('date') || $request->query('location') && $request->has('location')) {
            
        // $supply = CASupply::search($request)
        //         // ->where('tbl_transactions.user_id', '=', $user->id)
        //         ->where('tbl_transactions.status', '=', 'S')
        //         // ->where('tbl_transactions.type', '=', 'S')
        //         // ->where('tbl_cssupply.tentativePickupDate', '=', $start)
        //         ->where('tbl_cssupply.quantity','>',0)
        //         ->join('tbl_transactions','tbl_cssupply.refNumber', '=', 'tbl_transactions.refNumber')
        //         ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
        //         ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
        //         ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
        //         ->select('tbl_cssupply.refNumber','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
        //         'tbl_cssupply.id', 'tbl_units.unit', 'tbl_cssupply.tentativePickupDate','tbl_cssupply.harvestDate')
        //         ->groupBy('id')->paginate(10);
        
        // }
        Session::put('View_status', 'VS');
        return view('ca_nvsc.surplus.view-all')->with('supply',$supply);
                                                
    }
}


