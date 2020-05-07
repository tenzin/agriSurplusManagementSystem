<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
class UnitController extends Controller
{
   //unit create.
    public function unitcreate() 
    {
        $units = Unit::latest()->get();
        return view('Master.Units.unitadd',compact('units'));       

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

        return redirect('unit-create')->with("success","Successfully updated!");
    }

    //unit delete.
    public function unitdelete($id)
    {
        Unit::destroy($id);
        return redirect('unit-create')->with("success","Successfully deleted!");
    }
}
