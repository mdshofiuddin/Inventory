@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-md-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Invoice No #{{$invoice->invoice_no}}({{date('d-m-Y',strtotime($invoice->date))}})
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('invoice-pending-list')}}"><i class="fa fa-list"></i>Pending Invoice List</a>

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    @php
                                    $payment = \App\Model\Payment::where('invoice_id',$invoice->id)->first();
                                    @endphp

                                    <table width="100%">
                                        <tbody>
                                        <tr>
                                            <td width="15%"><strong>Customer Info </strong></td>
                                            <td width="25%"><strong>Name: </strong> {{$payment['customer']['name']}}</td>
                                            <td width="25%"><strong>Mobile No: </strong> {{$payment['customer']['mobile_no']}}</td>
                                            <td width="35%"><strong>Address: </strong> {{$payment['customer']['address']}}</td>
                                            </tbody>
                                            </tr>
                                        <tr>
                                            <td width="15%"></td>
                                            <td width="85%" colspan="3"><strong>Description:</strong> {{$invoice->description}}</td>
                                        </tr>
                                    </table>
                                    <form method="post" action="{{route('invoice-approve-store',$invoice->id)}}">
                                        @csrf
                                    <table width="100%" border="1" style="margin-bottom: 10px;">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">SL.</th>
                                            <th  class="text-center">Category</th>
                                            <th  class="text-center">Product Name</th>
                                            <th  style="background: #ddd; padding: 1px"  class="text-center" >Current Stock</th>
                                            <th  class="text-center">Quantity</th>
                                            <th  class="text-center">Unit Price</th>
                                            <th  class="text-center">Total Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $total_sum = '0';
                                        @endphp
                                        @foreach($invoice['invoice_details'] as $key => $details )
                                        <tr>
                                            <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                                            <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                                            <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                                            <td  style="padding: 1px"  class="text-center">{{$key+1}}</td>
                                            <td  style="padding: 1px"  class="text-center">{{$details['category']['name']}}</td>
                                            <td  style="padding: 1px"  class="text-center">{{$details['product']['name']}}</td>
                                            <td  style="padding: 1px; background: #ddd"  class="text-center">{{$details['product']['quantity']}}</td>
                                            <td  style="padding: 1px"  class="text-center">{{$details->selling_qty}}</td>
                                            <td  style="padding: 1px"  class="text-center">{{$details->unit_price}}</td>
                                            <td  style="padding: 1px"  class="text-center">{{$details->selling_price}}</td>
                                        </tr>
                                            @php
                                                $total_sum += $details->selling_price;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="text-sm-right"><strong>Sub Total</strong></td>
                                            <td class="text-center"><strong>{{$total_sum}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="6">Discount</td>
                                            <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="6">Paid Amount</td>
                                            <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="6">Due Amount</td>
                                            <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="6"><strong>Grand Total</strong></td>
                                            <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                        <button type="submit" class="btn btn-success">Invoice Approve</button>
                                    </form>




                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection





