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
    

    public function product_type()
    
    {
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

    public function ca_expriydate()
    
    {
        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('status', '!=', 'E')
                    ->where('status', '!=', 'S')
                    ->where('type', '=', 'S')
                    ->get('refNumber');

        //remove unnecessary character
        $refno1 = str_replace('[{"refNumber":"','',$checkno);
        $refno2 = str_replace('"}]','',$refno1);

        // $list = CASupply::where('refNumber', '=', $refno2)->first();
        $list = DB::table('tbl_cssupply')
                    ->where('refNumber', '=' , $refno2)
                    ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
                    ->where('user_id', '=' , $user->id)
                    ->first();

        if($checkno->isNotEmpty() && $list!='')
            { 
                Session::put('NextNumber', $refno2);
                return redirect('/supply_view'); 
            }

            $test = DB::table('tbl_transactions')
                ->where('user_id', '=' , $user->id)
                ->where('type', '=', 'S')
                ->where('status', '!=', 'S')
                ->where('status', '!=', 'E')
                ->where('refNumber', 'Like' , '%'.$refno.'%')
                ->get('refNumber');

        if($test->isNotEmpty())
         {
    
        return redirect('/ca-view');
        }

        return view('ca_nvsc.surplus.expirydate');
    }

    public function ca_store_transcation(Request $request)
    
    {
        $user = auth()->user();
        // $user_dzo = auth()->user()->dzongkhag_id;
        $date = date('Ym');
        $type = "S"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;

        //--------Check transaction not submitted
        $checkno = DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    // ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
                    ->where('status', '!=', 'S')
                    ->where('status', '!=', 'E')
                    ->where('type', '=', 'S')
                    ->get('refNumber');

        if($checkno->isNotEmpty())
        {
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            return $this->ca_supply_temp();
        }

        //-----Check referance number exist
        $ref = DB::table('tbl_transactions')
                ->where('user_id', '=' , $user->id)
                //  ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
                ->where('type', '=', 'S')
                ->where('refNumber', 'Like' , '%'.$refno.'%')
                ->get();
        
        if($ref->isEmpty())
        {
            $number = 1;
            $number = sprintf('%05d', $number);
            $nextNumber = $type.date('Ym').$number;
            
        }
        else
        {
            // $max = Transaction::where('refNumber','like', '%'.$refno.'%')->max('refNumber');
            $max=DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('dzongkhag_id','=',$user->dzongkhag_id)
                    ->where('refNumber', 'Like' , '%'.$refno.'%')
                    ->max('refNumber');
                    // dd($max);
            $number = substr($max,1,12);
            $number=$number+1;
            $nextNumber = $type.$number;
        }
       
        $expiry = $request->expiryday;
            
        //------Save Referance Number---
        $current = Carbon::now();
        $trialExpires = $current->addDays($expiry);

        $data = new Transaction;
        $data->refNumber = $nextNumber;
        $data->type = 'S';
        $data->expiryDate = $trialExpires;
        $data->status = 'A';
        $data->phone = $request->input('phone');
        $data->location = $request->input('location');
        $data->pickupdate = $request->input('pickupdate');
        $data->remark = $request->input('remark');
        $data->user_id = $user->id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;
        $data->save();
        // dd($data);

        $product_type= ProductType::all();
        $unit=Unit::all();

        $ref = DB::table('tbl_transactions')
                ->where('user_id', '=' , $user->id)
                ->where('refNumber', 'Like' , '%'.$nextNumber.'%')
                ->first();
        
        Session::put('View_status', 'A');
        return view('ca_nvsc.surplus.create',compact('nextNumber','product_type','unit','ref')); 
        
    }
    
    public function ca_supply_temp()

    {
        $user = auth()->user();
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();

        $ref = DB::table('tbl_transactions')
        ->where('refNumber', 'Like' , '%'.$nextNumber.'%')
        ->first();

        $supply = DB::table('tbl_cssupply')
                    ->where('refNumber', '=', $nextNumber)
                    ->where('dzongkhag_id', '=', $user->dzongkhag_id)
                    ->where('user_id', '=' , $user->id)
                    ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                    ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                    'tbl_cssupply.id')
                    ->get();

        $counts = DB::table('tbl_cssupply')
                    ->where('refNumber', '=', $nextNumber)
                    ->where('dzongkhag_id', '=', $user->dzongkhag_id)
                    ->where('user_id', '=' , $user->id)
                    ->count();

        Session::put('View_status', 'E');
        return view('ca_nvsc.surplus.create',compact('nextNumber','product_type','unit','supply','counts','ref'));
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

        if($checkno->isNotEmpty())
        {
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
        }
        $supply = DB::table('tbl_cssupply')
                    ->where('refNumber', '=', $refno2)
                    ->where('dzongkhag_id', '=', $user->dzongkhag_id)
                    ->where('user_id', '=' , $user->id)
                    ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                    ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                    ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                    'tbl_cssupply.id', 'tbl_units.unit')
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

    public function ca_store(Request $request)

    {
        $user = auth()->user();
        $request->session()->put('NextNumber', $request->input('refnumber'));

        $data = new CASupply;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('ut');
        // $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->user_id = $user->id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->save();
        
        return redirect('/ca_supply_temp')->with('nextNumber');
    }

    public function submit_ca_supply()

    {
        $user = auth()->user();
        $id = $this->request->input('ref_number');
        $current = Carbon::now();
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            // ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->update([
                'status' => 'S',
                'submittedDate' => $current
            ]);
        
    }

    public function ca_edit($id)

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
       
        return view('ca_nvsc.surplus.edit')->with('products',$product_type)
                                            ->with('units',$unit)
                                            ->with('nextNumber',$nextNumber)
                                            ->with('supplys',$supply)
                                            ->with('counts',$count)
                                            ->with('individuals',$individual)
                                            ->with('produce',$product);
    }


    public function ca_update(Request $request)

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
        // $data->harvestDate = $request->input('harvestdate');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();

        if(session('View_status')=='V')
        {
             return redirect('/supply_view')->with('msg','Saved successfully!!');
        } 
        else 
        {
            return redirect('/ca_supply_temp')->with('msg','Saved successfully!!');
        }

    }

    // Deleting
    public function ca_destroy($id)

    {
        $data= CASupply::find($id);
        $data->delete();

        if(session('View_status')=='V')
        {
            return redirect('/supply_view')->with('msg','Deleted successfully!!');
        } 
        else 
        {
            return redirect()->back()->with('msg','Deleted successfully!!');
        }

    }

    //Surplus Submitted Edit and Update 
    public function ca_edit_submitted($id)

    {      
        $supply = DB::table('tbl_cssupply')
                    ->where('tbl_cssupply.id', '=', $id)
                    ->orderBy('product_id')->get(); 
                
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        
        return view('ca_nvsc.surplus.edit-submitted')->with('products',$product_type)
                                                        ->with('units',$unit)
                                                        ->with('supply',$supply)
                                                        ->with('produce',$product);
    }

    public function ca_update_submitted(Request $request, $id)

    {
        $qty=floatval($request->input('hqty')) -floatval($request->input('quantity'));
        if($request->input('status') =='T')
        { 
            DB::table('tbl_history_ca_supply')->insert([
                'refNumber' => $request->input('refno'),
                'productType_id' => $request->input('producttype'),
                'product_id' => $request->input('product'),
                'quantity' => $request->input('quantity'),
                'unit_id' =>$request->input('unit'),
                'price' => $request->input('price'),
                'tentativePickupDate' => $request->input('date'),
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

    // View Submitted Details
    public function ca_view_surplus_details()

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
                            'tbl_cssupply.id', 'tbl_units.unit','tbl_transactions.location','tbl_transactions.pickupdate')
                            ->get();
            

        Session::put('View_status', 'VS');
        return view('ca_nvsc.surplus.view-submitted')->with('supply',$supply)
                                                     ->with('msg','Submitted product list.');   
    }

    //View individual Details
    public function ca_view_detail($id)
    
    {
        $user = auth()->user();
        $row = CASupply::findorfail($id);

        $test =$row->refNumber;
       
        $table = DB::table('tbl_transactions')
                    ->where('tbl_transactions.user_id','=', $user->id)
                    ->where('tbl_transactions.refNumber','=', $test)
                    // ->join('users','tbl_transactions.user_id', '=','users.id')
                    ->select('phone','location','remark','pickupdate','users.contact_number')
                    ->first();

                     dd($table);
        // $table = DB::table('tbl_transactions')
        //             ->where('tbl_transactions.user_id', '=', $user->id)
        //             ->join('users','tbl_transactions.user_id', '=','users.id')
        //             ->groupBy('users.id')
        //             ->select('users.contact_number')->get();

        // $rows = Demand::with('dzongkhag')->get();
        return view('ca_nvsc.surplus.view-details', compact('row','table'));
    }


    //Transcation history
    public function ca_show($id)

    {
        $user = auth()->user();
        $data = DB::table('tbl_cssupply')
                    ->where('tbl_cssupply.refNumber', '=', $id)
                    ->where('tbl_cssupply.dzongkhag_id','=',$user->dzongkhag_id)
                    ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                    ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                    ->select('tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                    'tbl_cssupply.id','tbl_units.unit')
                    ->get();

        return view('ca_nvsc.surplus.view-history-list')->with('supply',$data);
    }

    public function ca_show_history()

    {
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


    // CA to CA Surplus View
    public function view_surplus_nation_all()

    {

        $user = auth()->user();

        $supply = DB::table('tbl_cssupply')
                    // ->where('tbl_transactions.user_id', '=', $user->id)
                    ->where('tbl_transactions.status', '=', 'S')
                    ->where('tbl_transactions.type', '=', 'S')
                    ->where('tbl_cssupply.user_id', '!=', $user->id)
                    ->where('tbl_cssupply.quantity','>',0)
                    ->join('tbl_transactions','tbl_cssupply.refNumber', '=', 'tbl_transactions.refNumber')
                    ->join('tbl_product_types','tbl_cssupply.productType_id', '=', 'tbl_product_types.id')
                    ->join('tbl_products','tbl_cssupply.product_id', '=', 'tbl_products.id')
                    ->join('tbl_units','tbl_cssupply.unit_id', '=', 'tbl_units.id')
                    ->select('tbl_cssupply.refNumber','tbl_cssupply.quantity','tbl_product_types.type','tbl_products.product', 'tbl_cssupply.price',
                    'tbl_cssupply.id', 'tbl_units.unit','tbl_transactions.phone','tbl_transactions.location','tbl_transactions.remark','tbl_transactions.pickupdate')
                    ->groupBy('tbl_cssupply.id')->get();
                    // dd($supply);

        Session::put('View_status', 'VS');
        return view('ca_nvsc.surplus.view-all')->with('supply',$supply);
                                                
    }

    public function zero(Request $request, $id){


        $data = DB::table('tbl_cssupply')
                    ->where('id', '=', $id)
                    ->select('refNumber','quantity','productType_id','product_id', 'price',
                    'id','unit_id','status','harvestDate','dzongkhag_id')
                    ->first();

        $inserts = [];

        $inserts[] =  [
            'refNumber' => $data->refNumber,
            'productType_id' => $data->productType_id,
            'product_id' => $data->product_id,
            'quantity' => $data->quantity,
            'unit_id' =>$data->unit_id,
            'price' => $data->price,
            'harvestDate' => $data->harvestDate,
            'status' => 'T',
            'dzongkhag_id' => $data->dzongkhag_id
            ]; 

        DB::table('tbl_history_ca_supply')->insert($inserts);

        DB::table('tbl_cssupply')
                ->where('id', $id)
                ->update([
                        'status' => 'T',
                        'quantity' => '0'
                        ]);

        return redirect()->back()->with('success','Added successfully');
        
    }

    public function batch_edit($nextNumber){


        $user = auth()->user();
        $data =DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('tbl_transactions.refNumber','=', $nextNumber)
                    ->first(); 
        // $data = Transaction::find($nextNumber);
        // dd($data);
        $next = $nextNumber;
        // dd($next);
        return view('ca_nvsc.surplus..batch-edit',compact('data','next'));

    }

    public function update_batch(Request $request,$nextNumber){

        $user = auth()->user();

        DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        ->where('refNumber', $nextNumber)
        ->update([
                'expiryDate' => $request->input('expiryday'),
                'phone' => $request->input('phone'),
                'location' =>$request->input('location'),
                'remark' =>$request->input('remark'),
                'pickupdate' => $request->input('pickupdate')
                ]);

        return redirect('/supply_view');
        
    }

}
