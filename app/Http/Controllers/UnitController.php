<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
class UnitController extends Controller
{
    //list units.
    public function units()
    {
        $units = Unit::paginate(10);
        return view('Master.Units.unitlist',compact('units'));
    }

    //unit create.
    public function unitcreate() 
    {
        return view('Master.Units.unitcreate');

    }
    //unit store.
    public function unitstore(Request $request)
    {
        $unit = new Unit;
        $unit->unit = $request->unit;
        $unit->save();
        return redirect('unit-create')->with("success","Successfully saved!");
    }
    //unit edit.
    public function unitedit($id) 
    {
        $unit = Unit::find($id);
        return view('Master.Units.unitedit',compact('unit'));
    }
    //unit update.
    public function unitupdate(Request $request,$id)
    {
        $unit = Unit::find($id);
        $unit->unit = $request->unit;
        $unit->save();

        return redirect('unit-edit/'.$id)->with("success","Successfully updated!");
    }
}
