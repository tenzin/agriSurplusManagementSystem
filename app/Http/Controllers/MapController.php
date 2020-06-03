<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Gewog;
use App\User;
use DB;

class MapController extends Controller
{
    public function gewog_extension_map(){
        $gewog_extensions=DB::table('users')
                    ->join('tbl_gewogs','tbl_gewogs.id','=','users.gewog_id')
                    ->join('tbl_ex_surplus','tbl_ex_surplus.user_id','=','users.id')
                    ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                    ->select('tbl_gewogs.gewog', 'tbl_gewogs.latitude', 'tbl_gewogs.longitude', 'users.name', 'users.contact_number',
                        DB::raw("(SELECT SUM(tbl_ex_surplus.quantity)) AS surplus_quantity"))
                    ->where('users.role_id','=','7')
                    ->where('tbl_transactions.status', '=', 'S') //show only sibmitted/active quantities
                    ->groupBy('users.id')
                    ->get();

        return Response::json(array(
            'status' => 'success',
            'data' => $gewog_extensions->toArray()),
            200
        );
    }

    public function luc_map(){
        $lucs=DB::table('users')
                    ->join('tbl_gewogs','tbl_gewogs.id','=','users.gewog_id')
                    ->join('tbl_ex_surplus','tbl_ex_surplus.user_id','=','users.id')
                    ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                    ->select('tbl_gewogs.gewog', 'users.latitude', 'users.longitude', 'users.name', 'users.contact_number',
                        DB::raw("(SELECT SUM(tbl_ex_surplus.quantity)) AS surplus_quantity"))
                    ->where([
                        ['users.latitude','!=',null],
                        ['users.longitude','!=',null]
                    ])
                    ->where('users.role_id','=','8')
                    ->where('tbl_transactions.status', '=', 'S') //show only sibmitted/active quantities
                    ->groupBy('users.id')
                    ->get();

        return Response::json(array(
            'status' => 'success',
            'data' => $lucs->toArray()),
            200
        );
    }

    public function fg_map(){
        $fgs=DB::table('users')
                    ->join('tbl_gewogs','tbl_gewogs.id','=','users.gewog_id')
                    ->join('tbl_ex_surplus','tbl_ex_surplus.user_id','=','users.id')
                    ->join('tbl_transactions','tbl_transactions.id','=','tbl_ex_surplus.trans_id')
                    ->select('tbl_gewogs.gewog', 'users.latitude', 'users.longitude', 'users.name', 'users.contact_number',
                        DB::raw("(SELECT SUM(tbl_ex_surplus.quantity)) AS surplus_quantity"))
                    ->where([
                        ['users.latitude','!=',null],
                        ['users.longitude','!=',null]
                    ])
                    ->where('users.role_id','=','9')
                    ->where('tbl_transactions.status', '=', 'S') //show only sibmitted/active quantities
                    ->groupBy('users.id')
                    ->get();

        return Response::json(array(
            'status' => 'success',
            'data' => $fgs->toArray()),
            200
        );
    }

    public function ca_map(){
        $cas=DB::table('users')
                    ->join('tbl_dzongkhags','tbl_dzongkhags.id','=','users.dzongkhag_id')
                    ->join('tbl_cssupply','tbl_cssupply.user_id','=','users.id')
                    ->join('tbl_transactions','tbl_transactions.id','=','tbl_cssupply.trans_id')
                    ->select('tbl_dzongkhags.dzongkhag','users.latitude', 'users.longitude', 'users.name', 'users.contact_number',
                       DB::raw("(SELECT SUM(tbl_cssupply.quantity)) AS surplus_quantity"))
                    ->where([
                       ['users.latitude','!=',null],
                       ['users.longitude','!=',null]
                    ])
                    ->where('users.role_id','=','4')
                    ->where('tbl_transactions.status', '=', 'S') //show only sibmitted/active quantities
                    ->groupBy('users.id')
                    ->get();

        return Response::json(array(
            'status' => 'success',
            'data' => $cas->toArray()),
            200
        );
    }
}


//'tbl_ex_surplus.quantity'