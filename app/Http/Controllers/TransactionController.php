<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Transaction;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function transaction_exists()
    {
        $user = auth()->user();
        $data=DB::table('tbl_transactions')
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 'A')
            ->where('type', '=', 'D')
            ->get();
        if ($data->isEmpty()) {
            return null;
         } else {
            return response()->json($data);
         }
    }

    public function demand_import($id)
    {
        $user = auth()->user();
        $user = auth()->user();
        $date = date('Ym');
        $type = "D"; //Transaction type D: Demand; S: Supply
        $refno = $type.$date;
        $checkno = DB::table('tbl_transactions')
        ->where('user_id', '=' , $user->id)
        ->where('status', '!=', 'S')
        ->Where('status', '!=', 'E')
        ->where('type', '=', 'D')
        ->get('refNumber');

        if($checkno->isNotEmpty()){
            $refno1 = str_replace('[{"refNumber":"','',$checkno);
            $refno2 = str_replace('"}]','',$refno1);
            Session::put('NextNumber', $refno2);
            // return redirect('/demand_view');
            return $this->demand_temp();
        }
        $data=DB::table('tbl_demands')
            ->where('refNumber', '=', $id)
            ->get();
        
    }

    public function index()
    {
        //
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
        //
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
}
