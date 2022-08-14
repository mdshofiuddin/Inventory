@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Paid Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                                    Paid Customer List
                                </h3>
                                <a class="btn btn-success btn-sm float-right" target ="_blank" href="{{route('customers-paid-pdf')}}"><i class="fa fa-download"></i>Download Pdf</a>

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Customer Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Paid Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_paid = '0';
                                        @endphp
                                        @foreach($allData as $key => $payment)
                                            <tr>
                                                <td>{{$key +1}}</td>
                                                <td>{{$payment['customer']['name']}} ({{$payment['customer']['address']}}-{{$payment['customer']['mobile_no']}})</td>
                                                <td>Invoice No: #{{$payment['invoice']['invoice_no']}}</td>
                                                <td>{{date('d-m-Y', strtotime($payment['invoice']['date']))}}</td>
                                                <td>{{$payment->paid_amount}} Tk</td>

                                                <td>
                                                    <a class="btn btn-sm btn-success" title="Details" href="{{route('customers-details-invoice',$payment->invoice_id)}}"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $total_paid += $payment->paid_amount;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <td colspan="5" style="text-align: right; font-weight: bold">Grand Paid</td>
                                            <td style="font-weight: bold">{{$total_paid}} Tk</td>
                                        </tr>
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
@endsection




