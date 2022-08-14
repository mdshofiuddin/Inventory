@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Credit Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer </li>
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
                    <section class="col-lg-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Edit Invoice(Invoice No # {{$payment['invoice']['invoice_no']}})
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('customers-credit')}}"><i class="fa fa-list"></i>Credit Customer List</a>

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="30%"><strong>Name: </strong> {{$payment['customer']['name']}}</td>
                                        <td width="30%"><strong>Mobile No: </strong> {{$payment['customer']['mobile_no']}}</td>
                                        <td width="40%"><strong>Address: </strong> {{$payment['customer']['address']}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                    <table width="100%" border="1" style="border-color:gray">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">SL.</th>
                                            <th  class="text-center">Product Name</th>
                                            <th  class="text-center">Quantity</th>
                                            <th  class="text-center">Unit Price</th>
                                            <th  class="text-center">Total Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_sum = '0';
                                            $invoice_details = \App\Model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                                        @endphp
                                        @foreach($invoice_details as $key => $details )
                                            <tr>
                                                <td  style="padding: 1px"  class="text-center">{{$key+1}}</td>
                                                <td  style="padding: 1px"  class="text-center">{{$details['product']['name']}}</td>
                                                <td  style="padding: 1px"  class="text-center">{{$details->selling_qty}}</td>
                                                <td  style="padding: 1px"  class="text-center">{{$details->unit_price}}</td>
                                                <td  style="padding: 1px"  class="text-center">{{$details->selling_price}}</td>
                                            </tr>
                                            @php
                                                $total_sum += $details->selling_price;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right"><strong>Sub Total</strong></td>
                                            <td class="text-center"><strong>{{$total_sum}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4">Discount</td>
                                            <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4">Paid Amount</td>
                                            <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4">Due Amount</td>
                                            <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                            <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4"><strong>Grand Total</strong></td>
                                            <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <br/>
                                    <table class="table table-hover table-bordered">
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                        <th style="text-align: center; font-weight: bold">Paid Summary</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}

                                        <tbody>
                                        <tr>
                                            <td style="text-align: center" colspan="2" class="bg bg-secondary"><strong>Paid Summary</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; font-weight: bold">Date</td>
                                            <td style="font-weight: bold">Amount</td>
                                        </tr>
                                        @php
                                        $payment_details = \App\Model\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                                        @endphp
                                        @foreach($payment_details as $dtl)
                                            <tr>
                                                <td style="text-align: right">{{date('d-m-Y',strtotime($dtl->date))}}</td>
                                                <td>{{$dtl->current_paid_amount}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>




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

    <script type="text/javascript">
        //Paid Status
        $(document).on('change','#paid_status', function (){
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid'){
                $('#paid_amount').show();
            }else {
                $('#paid_amount').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    paid_status: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>

@endsection


