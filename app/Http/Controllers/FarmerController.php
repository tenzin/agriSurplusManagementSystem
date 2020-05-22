<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\ProductType;
use App\Transaction;
use App\EXSurplus;
use App\Unit;
use App\User;
use Session;
use Carbon\Carbon;

class FarmerController extends Controller
{
    //
    public $product_types;

    public function __construct(Request $request) {
        
        $this->request = $request;
        $this->middleware('auth');
        $this->product_types = ProductType::all();
    }

    public function products(){

        $id = $this->request->input('product_type');
        $product=DB::table('tbl_products')
            ->where('productType_id', '=', $id)
            ->get();
        return response()->json($product);
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

    public function create()
    {
        $user = auth()->user();
        $product_type = $this->product_types;
        $phone = $user->contact_number;
        $nextNumber;
        $days = 0;
       
        //check if there is any existing pending transaction that is not submitted the list.
        //status is A if saved but not submitted.
        
        
        $trans = Transaction::where('user_id','=',$user->id)
                            ->where('gewog_id','=',$user->gewog_id)
                            ->where('dzongkhag_id','=',$user->dzongkhag_id)
                            ->where('status','=','A')
                            ->where('type', '=', 'ES')
                            ->first();

                                   
        //if transaction exists.
        if($trans !== null)
        {
            $nextNumber = $trans->refNumber;
            Session::put('NextNumber', $nextNumber);   

            $now = Carbon::now();
            $days = $now->diffInDays($trans->expiryDate)+1;

        }
        else
        {
            $date = date('Ym');
            $type = "E"; //Transaction type D: Demand; S: Supply

            //check if transaction exist with submitted list.
            $ref = DB::table('tbl_transactions')
                    ->where('user_id', '=' , $user->id)
                    ->where('gewog_id','=',$user->gewog_id)
                    ->where('dzongkhag_id','=',$user->dzongkhag_id)
                    ->where('status','!=','A')
                    ->where('type', '=', 'ES')
                    ->first();
                  //  dd($ref);
        
            //get max refnumber of any previous number used.
            if($ref == null) {
                 //create a new ref Number.
                $number = 1;
                $number = sprintf("%05d", $number);
                $nextNumber = $type.$date.$number;
                Session::put('NextNumber', $nextNumber);

            } else 
            {      
               
                $max = Transaction::where('user_id','=',$user->id)
                                    ->where('gewog_id','=',$user->gewog_id)
                                    ->where('dzongkhag_id','=',$user->dzongkhag_id)
                                    ->where('status','!=','A')
                                    ->where('type', '=', 'ES')
                                    ->where('refNumber','like',$type.$date.'%')
                                    ->max('refNumber');
                // $max=DB::table('tbl_transactions')
                //                     ->where('user_id', '=' , $user->id)
                //                     ->where('gewog_id','=',$user->gewog_id)
                //                     // ->where('refNumber', 'Like' , '%'.$refno.'%')
                //                     ->max('refNumber');

                $number = substr($max,strlen($max) - 5,strlen($max));
                $number=$number+1;
                $number = sprintf("%05d", $number);
                $nextNumber = $type.date('Ym').$number;
            }

           
        }

    //
    $supply = DB::table('tbl_ex_surplus')
                    ->where('user_id','=',$user->id)
                    ->where('gewog_id','=',$user->gewog_id)
                    ->where('dzongkhag_id','=',$user->dzongkhag_id)
                    ->where('tbl_ex_surplus.refNumber','=',$nextNumber)
                    ->join('tbl_units','tbl_units.id','=','tbl_ex_surplus.unit_id')
                    ->join('tbl_products','tbl_products.id','=','tbl_ex_surplus.product_id')
                    ->select('tbl_ex_surplus.id','tbl_products.product','tbl_units.unit','tbl_ex_surplus.quantity','tbl_ex_surplus.price','tbl_ex_surplus.harvestDate')
                    ->orderBy('tbl_ex_surplus.created_at','DESC')
                    ->get();
  //  $unit=Unit::all();

     return view('farmers.surplus',compact('nextNumber','trans','product_type','supply','days','phone'));       
   //     return view('farmers.surplus_dynamic_input',compact('nextNumber','trans','product_type','supply','days','phone'));       

    }

    public function store(Request $request)
    {
        
        $user = auth()->user();
        $days;
        $phone = $user->contact_number;

        $product_type = $this->product_types;

     //   $request->session()->put('NextNumber', $request->input('refnumber'));
        $nextNumber = $request->input('refnumber');
        $expiry = $request->expiryday;

        //set default to 7 days if not provided that expiry date.
        if($expiry == null || $expiry == 0)
        {
            $expiry = 7;
        }
            
        //------calculate expiry date. based on day(s) ---
        $current = Carbon::now();
        $trialExpires = $current->addDays($expiry);

       
       //check if data exists.
        $transExists =  DB::table('tbl_transactions')
                            ->where('refNumber','=',$nextNumber)
                            ->where('user_id', '=' , $user->id)
                            ->where('gewog_id','=',$user->gewog_id)
                            ->where('dzongkhag_id','=',$user->dzongkhag_id)
                            ->where('status','=','A')
                            ->where('type', '=', 'S')
                            ->first();
        // if transaction exists for the given reference number then update or save a new record.
        if($transExists !== null)
        {
            $trans = Transaction::find($transExists->id);
            //get different in days.
            $now = Carbon::now();
            $days = $now->diffInDays($trans->expiryDate);

            $trans->expiryDate = $trialExpires;
            $trans->phone = $request->phone;
            $trans->location = $request->location;
            $trans->remark = $request->remark;
            $trans->pickupdate = $request->pickupdate;
            //update status to submitted 'S' in transaction if the submit is clicked.
            // if($request->subutton == "Yes")
            // {
            //     $trans->status = "S";
            //}
    
            $trans->save(); 

        }
        else 
        {  
            $trans = new Transaction;
            $trans->refNumber = $request->refnumber;
            $trans->type = 'ES';
            $trans->status = 'A';
            $trans->user_id = $user->id;
            $trans->dzongkhag_id = $user->dzongkhag_id;
            $trans->gewog_id = $user->gewog_id;

            $trans->expiryDate = $trialExpires;
            $trans->phone = $request->phone;
            $trans->location = $request->location;
            $trans->remark = $request->remark;
            $trans->pickupdate = $request->pickupdate;
            //update status to submitted 'S' in transaction if the submit is clicked.
            // if($request->subutton == "Yes")
            // {
            //     $trans->status = "S";
            // }
    
            $trans->save(); 
        }
        
       
        //save data in surplus details of products.
        $data = new EXSurplus;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->harvestDate = $request->harvestdate;
        $data->status = 'A';
        $data->user_id = $user->id;
        $data->price = $request->input('price');
        $data->gewog_id = $user->gewog_id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->save();

        $supply = DB::table('tbl_ex_surplus')
                    ->where('tbl_ex_surplus.refNumber','=',$nextNumber)
                    ->join('tbl_units','tbl_units.id','=','tbl_ex_surplus.unit_id')
                    ->join('tbl_products','tbl_products.id','=','tbl_ex_surplus.product_id')
                    ->select('tbl_ex_surplus.id','tbl_products.product','tbl_units.unit','tbl_ex_surplus.quantity','tbl_ex_surplus.price','tbl_ex_surplus.harvestDate')
                    ->orderBy('tbl_ex_surplus.created_at','DESC')
                    ->get();
         
        // if($request->subutton == "Yes")
        // {
            return redirect('farmer-create');
        // }
        // else {
     //  return redirect('farmer-store')->with('transid'=>$transid); //,compact('nextNumber','product_type'));
        // return view('farmers.surplus',compact('nextNumber','trans','product_type','supply','days','phone'))->with("message","successfully saved!");  
        // }

    } //end of store.

    //edit product.
    public function edit($id)
    {
        $product_type = $this->product_types;
        
        $product = EXSurplus::find($id);
        
        return view('farmers.surplusedit',compact('product_type','product'));
    }

    //update product.
    public function update(Request $request)
    {
        $data = EXSurplus::find($request->id);
        
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->price = $request->input('price');
        $data->harvestDate = $request->input('harvestdate');

        $data->save();
       
        return redirect('farmer-create')->with('msg','Saved successfully!!');

    }

    //view batch transactions.
    public function transactions()
    {
        $user = auth()->user();
        $trans = DB::table('tbl_transactions')
                        ->whereIn('status',['S','E'])
                        ->where('dzongkhag_id','=',$user->dzongkhag_id)
                        ->where('gewog_id','=',$user->gewog_id)
                        ->select('tbl_transactions.refNumber','tbl_transactions.phone','tbl_transactions.location','tbl_transactions.pickupdate','tbl_transactions.expirydate','tbl_transactions.remark')
                        ->paginate(15);
        
        return view('farmers.transactions',compact('trans'));

    }

    //batch ... each transaction details.
    public function batch($refno)
    {
        $trans = Transaction::where('refNumber','=',$refno)->first();
        $surplus = DB::table('tbl_ex_surplus')
                        ->where('tbl_ex_surplus.refNumber','=',$refno)
                        ->join('tbl_product_types','tbl_ex_surplus.productType_id','=','tbl_product_types.id')
                        ->join('tbl_products','tbl_ex_surplus.product_id','=','tbl_products.id')
                        ->join('tbl_units','tbl_ex_surplus.unit_id','=','tbl_units.id')
                        ->select('tbl_product_types.type','tbl_products.product','tbl_ex_surplus.quantity','tbl_units.unit','tbl_ex_surplus.price','tbl_ex_surplus.harvestDate')                       
                        ->get();

        return view('farmers.batch',compact('trans','surplus'));

    }

    //check if product exists.

    public function product_exists()
    {
        $id = $this->request->input('refNo');
        $data=DB::table('tbl_ex_surplus')
            ->where('refNumber', '=', $id)
            ->get();
        if ($data->isEmpty()) {
            return null;
         } else {
            return response()->json($id);
         }
    }
    //delete items.

    public function delete($id)
    {
        $surplus = EXSurplus::find($id);
        $surplus->delete();

        return redirect('farmer-create')->with("message","Deleted successfully!");
    }
   
    //update the status to 'S' in both transaction and ex_suplus tables.
    public function submit_surplus()
    {
        $user = auth()->user();
        $id = $this->request->input('refNumber');
        $current = Carbon::now();
        DB::table('tbl_transactions')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->where('gewog_id','=',$user->gewog->id)
            ->update([
                'status' => 'S',
                'updated_at' => $current
            ]);

            DB::table('tbl_ex_surplus')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->where('dzongkhag_id', '=' , $user->dzongkhag_id)
            ->where('gewog_id','=',$user->gewog->id)
            ->update([
                'status' => 'S',
                'updated_at' => $current
            ]);
        
    }
}
