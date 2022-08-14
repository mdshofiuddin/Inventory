<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Auth;

class SupplierController extends Controller
{
    public function view(){
        $allData = Supplier::all();
        return view('backend.supplier.supplier-view',compact('allData'));
    }
    public function add(){
        return view('backend.supplier.supplier-add');
    }
    public function store(Request $request){
        $supplier = new Supplier();
        $supplier->name         = $request->name;
        $supplier->mobile_no    = $request->mobile_no;
        $supplier->email        = $request->email;
        $supplier->address      = $request->address;
        $supplier->created_by   = Auth::user()->id;
        $supplier->save();
        return redirect()->route('suppliers-view')->with('success','Data saved successfully');
    }
    public function edit($id){
        $editData = Supplier::find($id);
        return view('backend.supplier.supplier-edit',compact('editData'));
    }
    public function update(Request $request, $id){
        $supplier               = Supplier::find($id);
        $supplier->name         = $request->name;
        $supplier->mobile_no    = $request->mobile_no;
        $supplier->email        = $request->email;
        $supplier->address      = $request->address;
        $supplier->updated_by   = Auth::user()->id;
        $supplier->save();
        return redirect()->route('suppliers-view')->with('success','Updated Successfully');
    }
    public function delete($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('suppliers-view')->with('success', 'Data deleted successfully');
    }

}
