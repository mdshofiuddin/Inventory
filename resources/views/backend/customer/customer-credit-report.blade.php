@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Customer wise Credit report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Credit report </li>
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
                                    Indivisual Credit report
    
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                 <form method="get" id="crditForm" action="{{route('customers-credit-report')}}">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg bg-gray">
                                    <tr>
                                        <th>SL.</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Due Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_due = '0';
                                    @endphp
                                    @foreach($allData as $key => $payment)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$payment['customer']['name']}} ({{$payment['customer']['address']}}-{{$payment['customer']['mobile_no']}})</td>
                                            <td>Invoice No: #{{$payment['invoice']['invoice_no']}}</td>
                                            <td>{{date('d-m-Y', strtotime($payment['invoice']['date']))}}</td>
                                            <td>{{$payment->due_amount}} Tk</td>
                                            @php
                                                $total_due += $payment->paid_amount;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right"><strong>Grand Total</strong></td>
                                        <td style="color: red">{{$total_due}} Tk</td>
                                    </tr>
                                    </tbody>
                                </table>
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


