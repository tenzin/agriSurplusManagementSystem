<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;
use App\ProductType;
use App\Transaction;
use App\Demand;
use App\Unit;
class CADemandController extends Controller
{
    
    protected $request;

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

    
    public function index()
    {
        $user = auth()->user();
        $date = date('Ym');
        $data=DB::table('tbl_transactions')
            ->where(\DB::raw('substr(refNumber, 0, 7)'), '=' , $date)
            ->get();
        $product_type= ProductType::all();
        $unit=Unit::all();
        
        if(empty($data->refNumber)) {
             $number = 1;
             $number = sprintf("%05d", $number);
             
         } else {
            $query = Transaction::latest('refNumber')->first();
             $number = substr($query->refNumber,1,13);
         }
         $type = "D"; //get type from url
        
        $nextNumber = $type.date('Ym').$number;

        $data = new Transaction();
        $data->refNumber = $nextNumber;
        $data->type = 'D';
        $data->expiryDate = date('Y-m-d');
        $data->status = 'A';
        $data->user_id = $user->id;
        $data->dzongkhag_id = $user->dzongkhag_id;
        $data->gewog_id = $user->gewog_id;

        $data->save();
        
        return view('ca_nvsc.demand.create',compact('nextNumber','product_type','unit'));
        // return redirect('ca_surplus_demand',compact('nextNumber','product_type','unit'));
       
    }

    public function demand_temp()
    {
        $nextNumber =session('NextNumber');
        $product_type= ProductType::all();
        $unit=Unit::all();
        return view('ca_nvsc.demand.create',compact('nextNumber','product_type','unit'));
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
        $data->status = 'R';
        $data->remarks = $request->input('remarks');
        $data->save();
        return redirect('/demand_temp')->with('nextNumber');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function view_surplus_demand_details(){
        
                return view('ca_nvsc.demand.surplus_demand_home');
            }
}

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class CADemandController extends Controller
// {
//     public function ca_surplus_demand(){               //view
        
//         return view('ca_nvsc.demand.create');
//     }

//     public function submit_surplus_demand_detail(){               //save second table
   
       
//         return view('ca_nvsc.demand.surplus_demand_home');
//     }

//     public function view_surplus_demand_details(){
        
//         return view('ca_nvsc.demand.surplus_demand_home');
//     }
// }
