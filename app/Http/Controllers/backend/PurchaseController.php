<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Invoice;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;
use Auth;
use App\Model\Purchase;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Model\Payment;

class PurchaseController extends Controller
{
    public function view(){
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.purchase.purchase-view',compact('allData'));
    }
    public function add(){
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('backend.purchase.purchase-add',$data);
        //return view('backend.product.product-add',compact('suppliers','units'));  Alternetive system
    }
    public function store(Request $request){
        if ($request->category_id == null){
            //dd('ok');
            return redirect()->back()->with('error','Sorry! do not select any item');
        }else{
            //dd('error');
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category;$i++){
                $purchase = new Purchase();
                $purchase->date              = date('y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no       = $request->purchase_no[$i];
                $purchase->supplier_id       = $request->supplier_id[$i];
                $purchase->category_id       = $request->category_id[$i];
                $purchase->product_id        = $request->product_id[$i];
                $purchase->buying_qty        = $request->buying_qty[$i];
                $purchase->unit_price        = $request->unit_price[$i];
                $purchase->buying_price      = $request->buying_price[$i];
                $purchase->description       = $request->description[$i];
                $purchase->created_by        = Auth::user()->id;
                $purchase->status            ='0';
                $purchase->save();

            }
        }
        return redirect()->route('purchase-view')->with('success','Data saved successfully');
    }
    
//    public function edit($id){
//        $data['editData'] = Product::find($id);
//        $data['suppliers'] = Supplier::all();
//        $data['units'] = Unit::all();
//        $data['categories'] = Category::all();
//        return view('backend.product.product-edit',$data);
//    }
//    public function update(Request $request, $id){
//        $product                        = Product::find($id);
//        $product->supplier_id           = $request->supplier_id;
//        $product->unit_id               = $request->unit_id;
//        $product->category_id           = $request->category_id;
//        $product->name                  = $request->name;
//        $product->updated_by            = Auth::user()->id;
//        $product->save();
//        return redirect()->route('products-view')->with('success','Updated Successfully');
//    }

    public function delete($id){
        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('purchase-view')->with('success', 'Data deleted successfully');
    }
    public function pendingList(){
        $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.pending-list-view',compact('allData'));
    }
    public function approve($id){
        $purchase           = Purchase::find($id);
        $product            = Product::where('id',$purchase->product_id)->first();
        $purchase_qty       = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity  = $purchase_qty;
        if ($product->save()){
            DB::table('purchases')
            ->where('id',$id)
            ->update(['status' => 1]);
        }
        return redirect()->route('purchase-pending-list')->with('success', 'Data approved successfully');
    }
    public function report(){
       return view('backend.purchase.purchase-report');
    }
    public function reportPdf(Request $request){
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.purchase-daily-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
