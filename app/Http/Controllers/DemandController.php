<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use App\Transaction;
use App\Demand;
use Session;
use Carbon\Carbon;
use DataTables;
class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $request;

    public function __construct(Request $request) {
        //$this->middleware('auth:admin');
        $this->request = $request;
    }
    //-----------Product dropdown----------//
    public function product_type(){
        $id = $this->request->input('product_type');
        $product=DB::table('tbl_products')
            ->where('productType_id', '=', $id)
            ->get();
        return response()->json($product);
    }

    public function product_exists(){
        $id = $this->request->input('refNo');
        $data=DB::table('demands')
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

    public function index()
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "D"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
        //--------Check transaction not submitted
        $checkno = DB::table('transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '!=', 'S')
        ->where('type', '=', 'D')
        ->get('refNumber');
        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            
            return $this->demand_temp();
        }

        //-----Check referance number exist
        $ref = DB::table('transactions')
            ->where('refNumber', 'Like' , '%'.$refno.'%')
            ->get();
        if(empty($ref)) {
            $number = 1;
            $number = sprintf("%05d", $number);
            $nextNumber = $type.date('Ym').$number;
        } else {
            $max = Transaction::where('refNumber','like', '%'.$refno.'%')->max('refNumber');
            $number = substr($max,1,12);
            $number=$number+1;
            $nextNumber = $type.$number;
        }

        //------Save Referance Number---
        $current = Carbon::now();
        $trialExpires = $current->addDays(7);

        $data = new Transaction;
        $data->refNumber = $nextNumber;
        $data->type = 'D';
        $data->expiryDate = $trialExpires;
        $data->status = 'A';
        $data->user_id = $user->id;
        $data->save();

        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        Session::put('View_status', 'A');
        return view('demand/new')->with('nextNumber',$nextNumber)
                                ->with('products',$product_type)
                                ->with('units',$unit);
    }
    public function demand_temp()
    {
        $nextNumber =session('NextNumber');
        $demand = DB::table('demands')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','demands.product_id', '=', 'tbl_products.id')
                ->select('demands.quantity','tbl_product_types.type','tbl_products.product', 'demands.price',
                'demands.id')
                ->get();
        $count = DB::table('demands')
                ->where('refNumber', '=', $nextNumber)
                ->count();
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        Session::put('View_status', 'E');
        return view('demand/new')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('nextNumber',$nextNumber)
                                ->with('demands',$demand)
                                ->with('counts',$count);
    }
    public function demand_view()
    {
        $refno =session('NextNumber');
        $refno1 = str_replace('[{"refNumber":"','',$refno);
        $refno2 = str_replace('"}]','',$refno1);
        $demand = DB::table('demands')
                ->where('refNumber', '=', $refno2)
                ->join('tbl_product_types','demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','demands.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','demands.unit_id', '=', 'tbl_units.id')
                ->select('demands.tentativeRequiredDate','demands.price','demands.quantity',
                        'tbl_product_types.type','tbl_products.product','tbl_units.unit',
                        'demands.id')
                ->get();
                Session::put('View_status', 'E');
        return view('demand/view')->with('demands',$demand)->with('msg','Your demand(s) not submitted');
    }

    public function submit_demand(){
        $user = auth()->user();
        $current = Carbon::now();
        $id = $this->request->input('ref_number');
        DB::table('transactions')
            ->where('refNumber', $id)
            ->where('user_id', $user->id)
            ->update(['status' => 'S'])
            ->update(['submittedDate' => $current]);
            return view('demand/msg')->with('msg','Your demand(s) submitted successfully!!!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->put('NextNumber', $request->input('refnumber'));
        //$nextNumber = $request->input('refnumber');
        $this->validate($request,[
            'product' =>'required',
            'producttype' =>'required',
            'price' =>'required',
            'unit' =>'required',
            'date' =>'required'

        ]);
        $data = new Demand;
        $data->refNumber = $request->input('refnumber');
        $data->productType_id = $request->input('producttype');
        $data->product_id = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->unit_id = $request->input('unit');
        $data->tentativeRequiredDate = $request->input('date');
        $data->price = $request->input('price');
        $data->status = 'A';
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('/demand_temp');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "D"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
        //--------Check transaction not submitted
        $checkno = DB::table('transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '!=', 'S')
        ->where('type', '=', 'D')
        ->get('refNumber');
        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
        }
        $demand = DB::table('demands')
                ->where('refNumber', '=', $refno2)
                ->join('tbl_product_types','demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','demands.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','demands.unit_id', '=', 'tbl_units.id')
                ->select('demands.quantity','tbl_product_types.type','tbl_products.product', 'demands.price',
                'demands.id', 'tbl_units.unit', 'demands.tentativeRequiredDate',)
                ->paginate(15);
        Session::put('View_status', 'V');
        return view('demand/view')->with('demands',$demand)
                                ->with('nextNumber',$refno2)
                                ->with('demands',$demand)
                                ->with('msg','Your demand(s) not submitted');
    }

    public function show_submit()
    {
        $user = auth()->user();
        $date = date('Ym');
        $type = "D"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
        //--------Check transaction not submitted
        $checkno = DB::table('transactions')
            ->where('user_id', '=' , $user->id)
            ->where('status', '=', 'S')
            ->where('type', '=', 'D')
            ->get();
            foreach($checkno as $data){
                $ref = array(
                    $data->refNumber,
                );
            }
        $demand = DB::table('demands')
                ->where('transactions.user_id', '=', $user->id)
                ->where('transactions.status', '=', 'S')
                ->where('transactions.type', '=', 'D')
                ->join('transactions','demands.refNumber', '=', 'transactions.refNumber')
                ->join('tbl_product_types','demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','demands.product_id', '=', 'tbl_products.id')
                ->join('tbl_units','demands.unit_id', '=', 'tbl_units.id')
                ->select('demands.refNumber','demands.quantity','tbl_product_types.type','tbl_products.product', 'demands.price',
                'demands.id', 'tbl_units.unit', 'demands.tentativeRequiredDate',)
                ->paginate(15);
        Session::put('View_status', 'VS');
        return view('demand/view-submitted')->with('demands',$demand)
                                ->with('msg','Submitted product list.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $nextNumber =session('NextNumber');
        $individual = Demand::find($id);
        
        $demand = DB::table('demands')
                ->where('refNumber', '=', $nextNumber)
                ->join('tbl_product_types','demands.productType_id', '=', 'tbl_product_types.id')
                ->join('tbl_products','demands.product_id', '=', 'tbl_products.id')
                ->select('demands.quantity','tbl_product_types.type','tbl_products.product', 'demands.price',
                'demands.id')
                ->get();
        $count = DB::table('demands')
                ->where('refNumber', '=', $nextNumber)
                ->count();
        //return $individual;    
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        //return $unit;
        return view('demand/edit')->with('products',$product_type)
                                ->with('units',$unit)
                                ->with('nextNumber',$nextNumber)
                                ->with('demands',$demand)
                                ->with('counts',$count)
                                ->with('individuals',$individual)
                                ->with('produce',$product);
    }
    public function edit_submitted($id)
    {      
        $demand = DB::table('demands')
                ->where('demands.id', '=', $id)
                ->get(); 
                //return $demand; 
        $product_type=DB::table('tbl_product_types')->get();
        $unit=DB::table('tbl_units')->get();
        $product=DB::table('tbl_products')->get();
        //return $unit;
        return view('demand/edit-submitted')->with('products',$product_type)
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

    public function update_submitted(Request $request, $id)
    {
        $qty=floatval($request->input('hqty')) -floatval($request->input('quantity'));
        if($request->input('status') =='T'){
            
            DB::table('history_demands')->insert([
                'refNumber' => $request->input('refno'),
                'productType_id' => $request->input('producttype'),
                'product_id' => $request->input('product'),
                'quantity' => $request->input('quantity'),
                'unit_id' =>$request->input('unit'),
                'price' => $request->input('price'),
                'status' => $request->input('status')
            ]);
        }

        $data = Demand::find($id);
        $data->quantity = $qty;
        $data->unit_id = $request->input('unit');
        $data->price = $request->input('price');
        $data->status = $request->input('status');
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('/submitted_show')->with('msg','Saved successfully!!');

        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Demand::find($id);
        $data->delete();
        if(session('View_status')=='V'){
            return redirect('/demand/show')->with('msg','Deleted successfully!!');
        } else {
            return redirect('/demand')->with('msg','Deleted successfully!!');
        }
    }
}
