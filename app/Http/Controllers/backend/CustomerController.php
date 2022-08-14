<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;
use Auth;
use App\Model\Payment;
use PDF;
use App\Model\PaymentDetail;
class CustomerController extends Controller
{
    public function view(){
        $allData = Customer::all();
        return view('backend.customer.customer-view',compact('allData'));
    }
    public function add(){
        return view('backend.customer.customer-add');
    }
    public function store(Request $request){
        $customer = new Customer();
        $customer->name         = $request->name;
        $customer->mobile_no    = $request->mobile_no;
        $customer->email        = $request->email;
        $customer->address      = $request->address;
        $customer->created_by   = Auth::user()->id;
        $customer->save();
        return redirect()->route('customers-view')->with('success','Data saved successfully');
    }
    public function edit($id){
        $editData = Customer::find($id);
        return view('backend.customer.customer-edit',compact('editData'));
    }
    public function update(Request $request, $id){
        $customer               = Customer::find($id);
        $customer->name         = $request->name;
        $customer->mobile_no    = $request->mobile_no;
        $customer->email        = $request->email;
        $customer->address      = $request->address;
        $customer->updated_by   = Auth::user()->id;
        $customer->save();
        return redirect()->route('customers-view')->with('success','Updated Successfully');
    }
    public function delete($id){
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers-view')->with('success', 'Data deleted successfully');
    }
    public function credit(){
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
      // dd($allData->toArray());
        return view('backend.customer.customer-credit',compact('allData'));
    }
    public function creditPdf(){
        $data['allData'] = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-credit-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('credit.pdf');
    }
    public function editInvoice($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        //dd($payment->toArray());
     return view('backend.customer.edit-invoice',compact('payment'));
    }

    public function updateInvoice(Request $request, $invoice_id){
        if ($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error', 'Sorry! paid maximum value');
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status=='full_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            //$payment_details->created_by = Auth::user()->id;
            $payment_details->save();

            return redirect()->route('customers-credit')->with('success','Invoice successfully Updated');
        }
    }
    public function detailsInvoice($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.customer.details-invoice',compact('payment'));
    }

    public function paid(){
        $allData = Payment::where('paid_status','!=', 'full_due')->get();
        // dd($allData->toArray());
        return view('backend.customer.customer-paid',compact('allData'));
    }
    public function paidPdf(){
        $data['allData'] = Payment::where('paid_status','!=', 'full_due')->get();
        $pdf = PDF::loadView('backend.pdf.customer-paid-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function customerWiseReport(){
        $customers = Customer::all();
        return view('backend.customer.customer-wise-report',compact('customers'));
    }
    public function customerCreditReport(Request $request){
         $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
         return view('backend.customer.customer-credit-report',compact('allData'));
    }
    public function customerPaidReport(Request $request){
        $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=', 'full_due')->get();
        return view('backend.customer.customer-paid-report',compact('allData'));
    }

}
