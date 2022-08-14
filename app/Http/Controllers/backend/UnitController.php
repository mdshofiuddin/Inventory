<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;
use App\Model\Unit;
use Auth;

class UnitController extends Controller
{
    public function view(){
        $allData = Unit::all();
        return view('backend.unit.unit-view',compact('allData'));
    }
    public function add(){
        return view('backend.unit.unit-add');
    }
    public function store(Request $request){
        $unit = new Unit();
        $unit->name         = $request->name;
        $unit->created_by   = Auth::user()->id;
        $unit->save();
        return redirect()->route('unites-view')->with('success','Data saved successfully');
    }
    public function edit($id){
        $editData = Unit::find($id);
        return view('backend.unit.unit-edit',compact('editData'));
    }
    public function update(Request $request, $id){
        $unit               = Unit::find($id);
        $unit->name         = $request->name;
        $unit->updated_by   = Auth::user()->id;
        $unit->save();
        return redirect()->route('unites-view')->with('success','Updated Successfully');
    }
    public function delete($id){
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('unites-view')->with('success', 'Data deleted successfully');
    }
}
