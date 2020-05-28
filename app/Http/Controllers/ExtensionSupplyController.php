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
use App\Gewog;
use App\CASupply;
use Session;
use Carbon\Carbon;


class ExtensionSupplyController extends Controller
{
    
    public function __construct(Request $request) {
        
        $this->request = $request;
        $this->middleware('auth');
    }
    
    public function product_type()
    
    {
        $id = $this->request->input('product_type');
        $product=DB::table('tbl_products')
                    ->where('productType_id', '=', $id)
                    ->get();
        return response()->json($product);
    }

    public function surplus_exists()
    
    {
        $id = $this->request->input('refNo');
        $data=DB::table('tbl_ex_surplus')
                ->where('refNumber', '=', $id)
                ->get();
        if ($data->isEmpty()) 
        {
            return null;
        } 
        else 
        {
            return response()->json($id);
        }
    }

    public function unit_product(){

        $id = $this->request->input('product');

        $product=DB::table('tbl_unit_product_mappings')
                    ->where('product_id', '=', $id)
                    ->join('tbl_units','tbl_units.id','=','tbl_unit_product_mappings.unit_id')
                    ->select('tbl_units.unit','tbl_unit_product_mappings.unit_id')
                    ->get();

        $checkdata = DB::table('tbl_unit_product_mappings')->where('product_id', '=', $id)->exists();
      
        if($checkdata)
        {
            return response()->json($product);
        }   
        else
        {
            $units = DB::table('tbl_units')
                            ->select('tbl_units.unit',DB::raw("tbl_units.id as unit_id"))
                            ->get();
            return response()->json($units);
        }         
      
    }

    public function ex_expiryday()
    
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "E"; //Transaction type D: Demand; S: Supply; E: Extension;
        $refno = $type.$date;

        //Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('status', '!=', 'S')
                    ->where('status', '!=', 'E')
                    ->where('type', '=', 'ES')
                    ->get('refNumber');

                    // dd($checkno);
        //remove unnecessary character
        $refno1 = str_replace('[{"refNumber":"','',$checkno);
        $refno2 = str_replace('"}]','',$refno1);
                    
        $list = DB::table('tbl_ex_surplus')
                    ->where('refNumber', '=' , $refno2)
                    ->where('gewog_id', '=' , $user->gewog_id)
                    ->where('user_id', '=' , $user->id)
                    ->first();
                
        if($checkno->isNotEmpty() && $list!='')
        {
            Session::put('NextNumber', $refno2);
            return redirect('/ex_supply_view');   
        }

        $test = DB::table('tbl_transactions')
                ->where('user_id', '=' , $user->id)
                ->where('type', '=', 'ES')
                ->where('status', '!=', 'S')
                ->where('status', '!=', 'E')
                ->where('refNumber', 'Like' , '%'.$refno.'%')
                ->get('refNumber');

        if($test->isNotEmpty())
         {
    
        return redirect('/surplus-view');
        }
 
        return view('extension_farmer.supply.expiryday');
        
    }

    public function ex_store_transaction(Request $request)
    
    {
        // dd('sjhdfgds');
        $user = auth()->user();
        $date = date('Ym');
        $type = "E"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('status', '!=', 'S')
                    ->where('status', '!=', 'E')
                    ->where('type', '=', 'ES')
                    ->get('refNumber');

        if($checkno->isNotEmpty())
        {
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            return $this->ex_supply_temp();
        }

        //Check referance number exist
        $ref = DB::table('tbl_transactions')
                ->where('user_id', '=' , $user->id)
                ->where('type', '=', 'ES')
                ->where('refNumber', 'Like' , '%'.$refno.'%')
                ->get();

                // dd($ref);

        if($ref->isEmpty()) 
        {
            $number = 1;
            $number = sprintf("%05d", $number);
            $nextNumber = $type.date('Ym').$number;
        } 
        else 
        {
            $max=DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('gewog_id','=',$user->gewog_id)
                    ->where('refNumber', 'Like' , '%'.$refno.'%')
                    ->max('refNumber');
                    // dd($max);
            // $max = Transaction::where('gewog_id','=',$user->gewog_id)->max('refNumber');
            // $max = Transaction::where('refNumber','like', '%'.$refno.'%')->get();
            $number = substr($max,1,12);
            $number=$number+1;
            $nextNumber = $type.$number;
        }

        //    dd($nextNumber );

            $expiry = $request->expiryday;
            
            //------Save Referance Number---
            $current = Carbon::now();
            $trialExpires = $current->addDays($expiry);

            $data = new Transaction;
            $data->refNumber = $nextNumber;
            $data->type = 'ES';
            $data->expiryDate = $trialExpires;
            $data->status = 'A';
            $data->phone = $request->input('phone');
            $data->location = $request->input('location');
            $data->pickupdate = $request->input('pickupdate');
            $data->remark = $request->input('remark');
            $data->user_id = $user->id;
            $data->dzongkhag_id = $user->dzongkhag_id;
            $data->gewog_id = $user->gewog_id;

            // dd($data);
            $data->save();

            $product_type= ProductType::all();
            $unit=Unit::all();

            $table = DB::table('tbl_transactions')
                ->where('refNumber', 'Like' , '%'.$nextNumber.'%')
                ->where('user_id', '=' , $user->id)
                // ->where('status', '!=', 'S')
                // ->where('status', '!=', 'E')
                // ->where('type', '=', 'ES')
                ->first();
            // dd($table);
            $trans = $data->id;
            Session::put('View_status', 'A');
    
            return view('extension_farmer.supply.create',compact('nextNumber','product_type','trans','unit','table'));
    }

    public function ex_supply_temp()

    {

        $user = auth()->user();
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();


        $table = DB::table('tbl_transactions')
        ->where('refNumber', 'Like' , '%'.$nextNumber.'%')
        ->where('user_id', '=' , $user->id)
        ->first();

        $trans = $table->id;

        $supply = DB::table('tbl_ex_surplus')
                    ->where('refNumber', '=', $nextNumber)
                    ->where('gewog_id', '=', $user->gewog_id)
                    ->where('user_id', '=' , $user->id)
                    ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                    ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                    'tbl_ex_surplus.id')
                    ->get();

        $count = DB::table('tbl_ex_surplus')
                    ->where('refNumber', '=', $nextNumber)
                    ->where('gewog_id', '=', $user->gewog_id)
                    ->where('user_id', '=' , $user->id)
                    ->count();

       

        return view('extension_farmer.supply.create',compact('nextNumber','trans','product_type','unit','supply','count','table'));
    }


    public function ex_supply_view()

    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "E"; //Transaction type D: Demand; S: Supply
        $refno =session('NextNumber');

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
                        ->where('user_id', '=' , $user->id)
                        ->where('status', '!=', 'S')
                        ->where('status', '!=', 'E')
                        ->where('type', '=', 'ES')
                        ->get('refNumber');

        if($checkno->isNotEmpty())
        {
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
        }
        $supply = DB::table('tbl_ex_surplus')
                    ->where('refNumber', '=', $refno2)
                    ->where('gewog_id', '=', $user->gewog_id)
                    ->where('user_id', '=' , $user->id)
                    ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                    ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                    ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                    'tbl_ex_surplus.id', 'tbl_units.unit', 'tbl_ex_surplus.harvestDate')
                    ->paginate(15);

        Session::put('View_status', 'V');
        return view('extension_farmer.supply.view')->with('supply',$supply)
                                                    ->with('nextNumber',$refno2)
                                                    ->with('msg','Your demand(s) not submitted');
        
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
        $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'A';                    //Active=A
        $data->user_id = $user->id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;
        $data->trans_id =$request->input('trans');
        // dd($data);
        $data->save();
    

        return redirect('/ex_supply_temp')->with('nextNumber');
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

    // Edit and Update Surplus Details While it is not Submitted
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
        $data->price = $request->input('price');
        $data->status = 'A';
        
        $data->save();

        if(session('View_status')=='V')
        {
            return redirect('ex_supply_view')->with('msg','Saved successfully!!');
        }
        else
        {
            return redirect('/ex_supply_temp')->with('msg','Saved successfully!!');
        }
    }

    // Deleting
    public function destroy($id)

    {
        $activity= ExSurplus::find($id);
        $activity->delete();

        if(session('View_status')=='V')
        {
            return redirect('ex_supply_view')->with('msg','Deleted successfully!!');
        } 
        else 
        {
           return redirect()->back()->with('msg','Deleted successfully!!');
        }  
    }


    public function batch_edit($id){

        $user = auth()->user();

        $data =DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('tbl_transactions.id','=', $id)
                    ->first(); 
        // $data = Transaction::find($nextNumber);
        
        // $next = $nextNumber;
        // dd($next);
        return view('extension_farmer.supply.batch-edit',compact('data'));

    }

    public function update_batch(Request $request,$id){

        $user = auth()->user();

        DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        ->where('id', $id)
        ->update([
                'expiryDate' => $request->input('expiryday'),
                'phone' => $request->input('phone'),
                'location' =>$request->input('location'),
                'remark' =>$request->input('remark'),
                'pickupdate' => $request->input('pickupdate')
                ]);

        return redirect('/surplus-view');
        
    }

    //Surplus Submitted Edit and Update 
    public function edit_submitted($id)

    {      
        $surplus = DB::table('tbl_ex_surplus')
                    ->where('tbl_ex_surplus.id','=', $id)
                    ->get(); 

                    // dd($surplus);

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
        $user = auth()->user();

        $qty=floatval($request->input('hqty')) -floatval($request->input('quantity'));
        if($request->input('status') =='T'){
            
            DB::table('tbl_ex_surplus_history')->insert([
                'ex_surplus_id' =>$id,
                'refNumber' => $request->input('refno'),
                'productType_id' => $request->input('producttype'),
                'product_id' => $request->input('product'),
                'quantity' => $request->input('quantity'),
                'unit_id' =>$request->input('unit'),
                'price' => $request->input('price'),
                'status' => $request->input('status'),
                'harvestDate' => $request->input('harvestDate'),
                'gewog_id' => $user->gewog_id,
                'dzongkhag_id' => $user->dzongkhag_id,
                'trans_id' => $request->input('trans_id')

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

    // View Submitted Details
    public function view_supply_details(Request $request)
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "E"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
        $location = Gewog::all();

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
            ->where('user_id', '=' , $user->id)
            ->where('status', '=', 'S')
            ->where('status', '!=', 'E')
            ->where('type', '=', 'ES')
            ->get();
            
        foreach($checkno as $data){
            $ref = array(
                $data->refNumber,
            );
            }
        if($user->role_id==4 || $user->role_id==5)

            {

            $locations = Gewog::all(); 
    
        

                            $product =EXSurplus::with('product','gewog','unit','transaction') ->where('tbl_ex_surplus.quantity','>',0) 
                            ->join('tbl_transactions','tbl_ex_surplus.trans_id', '=', 'tbl_transactions.id')->get();

                            // $product = DB::table('tbl_ex_surplus')
                            // ->where('tbl_ex_surplus.quantity','>',0)
                            // ->join('tbl_transactions','tbl_ex_surplus.trans_id', '=', 'tbl_transactions.id')
                            // ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                            // ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                            // ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                            // // ->join('tbl_gewogs','tbl_ex_surplus.gewog_id', '=', 'tbl_gewogs.id')
                            // ->select('tbl_ex_surplus.refNumber','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                            // 'tbl_ex_surplus.id','tbl_units.unit','tbl_ex_surplus.harvestDate','tbl_transactions.location','tbl_transactions.pickupdate','tbl_transactions.phone','tbl_transactions.remark')
                            // ->get('tbl_ex_surplus.trans_id');

            } 
            else 
            {

            $product = DB::table('tbl_ex_surplus')
                            ->where('tbl_transactions.user_id', '=', $user->id)
                            // ->where('tbl_transactions.gewog_id', '=', $user->gewog_id)
                            ->where('tbl_transactions.status', '=', 'S')
                            ->where('tbl_transactions.type', '=', 'ES')
                            ->where('tbl_ex_surplus.gewog_id', '=', $user->gewog_id)
                            ->where('tbl_ex_surplus.user_id', '=', $user->id)
                            ->where('tbl_ex_surplus.quantity','>',0)
                            ->join('tbl_transactions','tbl_ex_surplus.refNumber', '=', 'tbl_transactions.refNumber')
                            // ->join('tbl_transactions','tbl_ex_surplus.gewog_id', '=', 'tbl_transactions.gewog_id')
                            ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                            ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                            ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                            ->select('tbl_ex_surplus.refNumber','tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                            'tbl_ex_surplus.id', 'tbl_units.unit','tbl_ex_surplus.harvestDate','tbl_transactions.location','tbl_transactions.pickupdate')
                            ->orderBy('id')->get();
                            // dd($product);
            
            } 

        Session::put('View_status', 'VS');
       
        return view('extension_farmer.supply.supply_home',compact('product','location','user'))->with('msg','Submitted Product List.');
    }


    //View individual Details
    public function ex_view_detail($id)
    
    {  
        $user=auth()->user();
        $row = EXSurplus::find($id);

        $test =$row->refNumber;
       
        $table = DB::table('tbl_transactions')
                    ->where('tbl_transactions.user_id','=', $user->id)
                    ->where('tbl_transactions.refNumber','=', $test)
                    ->select('phone','location','remark','pickupdate')
                    ->first();
                    // dd($table);
                    

        return view('extension_farmer.supply.surplusview', compact('row','table'));
    }


    //Transcation history
    public function ex_show($id)

    {
        $user = auth()->user();
        $data = DB::table('tbl_ex_surplus')
                    ->where('tbl_ex_surplus.refNumber', '=', $id)
                    ->where('tbl_ex_surplus.gewog_id','=',$user->gewog_id)
                    // ->where('tbl_ex_surplus.user_id','=',$user->id)
                    ->join('tbl_product_types','tbl_ex_surplus.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_ex_surplus.product_id', '=', 'tbl_products.id')
                    ->join('tbl_units','tbl_ex_surplus.unit_id', '=', 'tbl_units.id')
                    ->select('tbl_ex_surplus.quantity','tbl_product_types.type','tbl_products.product', 'tbl_ex_surplus.price',
                    'tbl_ex_surplus.id','tbl_units.unit')
                    ->get();

        return view('extension_farmer.supply.view-history-list')->with('supply',$data);
    }

    public function show_history()

    {
        $user = auth()->user();
        $data = DB::table('tbl_transactions')
                    ->where('user_id', '=', $user->id)
                    // ->where('gewog_id', '=', $user->gewog_id)
                    ->where('status', '=', 'E')
                    ->where('type','=', 'ES')
                    ->orderBy('submittedDate','DESC')
                    ->paginate(15);
                
        return view('extension_farmer.supply.supplyhistory')->with('supply',$data)
                                                            ->with('msg','Your Surplus history');
    }

    public function zero(Request $request, $id){


        $data = DB::table('tbl_ex_surplus')
                    ->where('id', '=', $id)
                    ->select('refNumber','quantity','productType_id','product_id', 'price',
                    'id','unit_id','status','harvestDate','dzongkhag_id','gewog_id')
                    ->first();

        $inserts = [];

        $inserts[] =  [
            'ex_surplus_id' => $data->id,
            'refNumber' => $data->refNumber,
            'productType_id' => $data->productType_id,
            'product_id' => $data->product_id,
            'quantity' => $data->quantity,
            'unit_id' =>$data->unit_id,
            'price' => $data->price,
            'harvestDate' => $data->harvestDate,
            'status' => 'T',
            'dzongkhag_id' => $data->dzongkhag_id,
            'gewog_id' => $data->gewog_id
            ]; 

        DB::table('tbl_ex_surplus_history')->insert($inserts);

        DB::table('tbl_ex_surplus')
                ->where('id', $id)
                ->update([
                        'status' => 'T',
                        'quantity' => '0'
                        ]);

        return redirect()->back()->with('success','Added successfully');
        
    }
    
}
