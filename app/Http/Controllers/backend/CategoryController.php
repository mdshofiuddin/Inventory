<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;
use App\Model\Category;
use Auth;

class CategoryController extends Controller
{
    public function view(){
        $allData = Category::all();
        return view('backend.category.category-view',compact('allData'));
    }
    public function add(){
        return view('backend.category.category-add');
    }
    public function store(Request $request){
        $unit = new Category();
        $unit->name         = $request->name;
        $unit->created_by   = Auth::user()->id;
        $unit->save();
        return redirect()->route('categories-view')->with('success','Data saved successfully');
    }
    public function edit($id){
        $editData = Category::find($id);
        return view('backend.category.category-edit',compact('editData'));
    }
    public function update(Request $request, $id){
        $unit               = Category::find($id);
        $unit->name         = $request->name;
        $unit->updated_by   = Auth::user()->id;
        $unit->save();
        return redirect()->route('categories-view')->with('success','Updated Successfully');
    }
    public function delete($id){
        $unit = Category::find($id);
        $unit->delete();
        return redirect()->route('categories-view')->with('success', 'Data deleted successfully');
    }
}
