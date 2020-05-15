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
use App\User;
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
            //remove unnecessary character
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
                $refno2 = str_replace('"}]','',$refno1);

                $list = EXSurplus::where('refNumber', '=', $refno2)->first();
                if($checkno->isNotEmpty() && $list!=''){
                    
                    Session::put('NextNumber', $refno2);
                    return redirect('/ex_supply_view');
                    
                }
            // if($checkno->isNotEmpty()){
            //     $refno1 = str_replace('[{"refNumber":"','',$checkno);
            //     $refno2 = str_replace('"}]','',$refno1);
            //     Session::put('NextNumber', $refno2);
            //     return redirect('/ex_supply_view');
            // }

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

            Session::put('View_status', 'A');
    
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
            return redirect('ex_supply_view')->with('msg','Saved successfully!!');
        }else
        return redirect('/ex_supply_temp')->with('msg','Saved successfully!!');
    }



    public function ex_supply_view()
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno =session('NextNumber');
        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '!=', 'S')
        ->where('type', '=', 'S')
        ->get('refNumber');
        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
        }
        $supply = DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $refno2)
                ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                'tbl_ex_surplus.id', 'tbl_units.unit', 'tbl_ex_surplus.tentativePickupDate','tbl_ex_surplus.harvestDate')
                ->paginate(15);
        Session::put('View_status', 'V');
        return view('extension_farmer.supply.view')->with('supply',$supply)
                                ->with('nextNumber',$refno2)
                                ->with('msg','Your demand(s) not submitted');
        // $refno =session('NextNumber');
        // $refno1 = str_replace('[{"refNumber":"','',$refno);
        // $refno2 = str_replace('"}]','',$refno1);
        // $supply = DB::table('tbl_ex_surplus')
        //         ->where('tbl_ex_surplus.refNumber', '=', $refno2)
        //         ->where('tbl_transactions.status', '=', 'A')
        //         ->join('tbl_transactions','tbl_transactions.refNumber', '=', 'tbl_ex_surplus.refNumber')
        //         ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
        //         ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
        //         ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
        //         ->select('tbl_ex_surplus.tentativePickupDate','tbl_ex_surplus.harvestDate','tbl_ex_surplus.price','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product','tbl_units.unit','tbl_ex_surplus.id')
        //         ->get();
        //         //return $refno;  
        // return view('extension_farmer.supply.view',compact('supply','refno2'))->with('msg','Please Submit Your Surplus Information');
    }

    public function ex_submit_supply()
    {
        
        $user = auth()->user();
        $id = $this->request->input('ref_number');
        $current=Carbon::now();
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->update(['status' => 'S',
                      'submittedDate'=>$current
                      ]);
    }
    
    public function destroy($id)
    {
        $activity= ExSurplus::find($id);
        $activity->delete();
        if(session('View_status')=='V'){
            return redirect('ex_supply_view')->with('msg','Deleted successfully!!');
        } else {
           return redirect()->back()->with('msg','Deleted successfully!!');
        }  
    }
    
    public function view_supply_details()
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
    
        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
            ->where('user_id', '=' , $user->id)
            ->where('status', '=', 'S')
            ->where('status', '!=', 'E')
            ->where('type', '=', 'S')
            ->get();
            foreach($checkno as $data){
                $ref = array(
                    $data->refNumber,
                );
            }
        $product = DB::table('tbl_ex_surplus')
                ->where('tbl_transactions.user_id', '=', $user->id)
                ->where('tbl_transactions.status', '=', 'S')
                ->where('tbl_transactions.type', '=', 'S')
                ->where('tbl_ex_surplus.dzongkhag_id', '=', $user->dzongkhag_id)
                ->where('tbl_ex_surplus.quantity','>',0)
                ->join('tbl_transactions','tbl_ex_surplus.refNumber', '=', 'tbl_transactions.refNumber')
                ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                ->select('tbl_transactions.submittedDate','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                'tbl_ex_surplus.id', 'tbl_units.unit', 'tbl_ex_surplus.tentativePickupDate','tbl_ex_surplus.harvestDate')
                ->get();
                //  dd($product);
        Session::put('View_status', 'VS');
       
        return view('extension_farmer.supply.supply_home',compact('product'))->with('msg','Submitted Product List.');
    }

    //view individual
    public function ex_view_detail($id){

        $user=auth()->user();

        $row = EXSurplus::find($id);
        $table = DB::table('tbl_transactions')
                ->where('tbl_transactions.user_id','=', $user->id)
                ->join('users','tbl_transactions.user_id','=','users.id')
                ->orderBy('users.id')
                ->select('users.contact_number')->get();
               // dd( $contact);
        return view('extension_farmer.supply.surplusview', compact('row','table'));
    }


    //surplus submitted edit 
    public function edit_submitted($id)
    {      
        $surplus = DB::table('tbl_ex_surplus')
                ->where('tbl_ex_surplus.id','=', $id)
                ->get(); 
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        return view('extension_farmer.supply.edit-submitted')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('demands',$surplus)
                                ->with('produce',$product);
    }
    
    
    public function update_submitted(Request $request, $id)
    {
        $qty=floatval($request->input('hqty')) -floatval($request->input('quantity'));
        if($request->input('status') =='T'){
            
            DB::table('tbl_ex_surplus_history')->insert([
                'refNumber' => $request->input('refno'),
                'productType_id' => $request->input('producttype'),
                'product_id' => $request->input('product'),
                'quantity' => $request->input('quantity'),
                'unit_id' =>$request->input('unit'),
                'price' => $request->input('price'),
                'status' => $request->input('status')
            ]);
        }

        $data = EXSurplus::find($id);
        $data->quantity = $qty;
        $data->unit_id = $request->input('unit');
        $data->price = $request->input('price');
        $data->status = $request->input('status');
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('view_supply_details')->with('msg','Saved successfully!!');     
    }

    //history
    public function show_history()
    {
        $user = auth()->user();
        $data = DB::table('tbl_transactions')
                ->where('user_id', '=', $user->id)
                ->where('status', '=', 'E')
                ->where('type','=', 'S')
                ->orderBy('submittedDate','DESC')
                ->paginate(15);
        return view('extension_farmer.supply.supplyhistory')->with('supply',$data)
                                ->with('msg','Your Surplus history');
    }
    public function ex_show($id)
    {
        $data = DB::table('tbl_ex_surplus')
                ->where('tbl_ex_surplus.refNumber', '=', $id)
                ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                'tbl_ex_surplus.id','tbl_units.unit')
                ->get();
        return view('extension_farmer.supply.view-history-list')->with('supply',$data);
    }

}
