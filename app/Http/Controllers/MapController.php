<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Gewog;
use DB;

class MapController extends Controller
{
    public function index(){

        $gewogs=DB::table('tbl_gewogs')
                    //->where('tbl_gewogs.id','=','users.gewog_id')
                    ->join('users','tbl_gewogs.id','=','users.gewog_id')
                    ->select('gewog', 'latitude', 'longitude', 'users.name', 'users.contact_number')
                    ->get();
        //dd($gewogs);

        return Response::json(array(
            'status' => 'success',
            'gewogs' => $gewogs->toArray()),
            200
            
        );
    }
}
