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
                    ->select('gewog', 'latitude', 'longitude')
                    ->get();
        //dd($gewogs);

        return Response::json(array(
            'status' => 'success',
            'gewogs' => $gewogs->toArray()),
            200
            
        );
    }
}
