<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cunit;
class CUnitController extends Controller
{
    //unit create.
    public function cunitcreate() 
    {
        $cunits = Cunit::latest()->get();
        return view('Master.Cultivation_units.cunitadd',compact('cunits'));

    }
    //unit store.
    public function cunitstore(Request $request)
    {
        $unit = new Cunit;
        $unit->unit = $request->cunit;
        $unit->save();
        return redirect('cunit-create')->with("success","Successfully saved!");
    }
    //unit edit.
    public function cunitedit($id) 
    {
        $unit = Cunit::find($id);
        return view('Master.Cultivation_units.cunitedit',compact('unit'));
    }
    //unit update.
    public function cunitupdate(Request $request,$id)
    {
        $unit = Cunit::find($id);
        $unit->unit = $request->cunit;
        $unit->save();

        return redirect('cunit-create')->with("success","Successfully updated!");
    }

    //unit delete.
    public function cunitdelete($id)
    {
        Cunit::destroy($id);
        return redirect('cunit-create')->with("success","Successfully deleted!");
    }

}
