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
                                   Pending Invoice List
                                </h3>
{{--                                <a class="btn btn-success btn-sm float-right" href="{{route('invoice-add')}}"><i class="fa fa-plus-circle"></i>Add Invoice</a>--}}

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <table id="example1" class="table table-bordered table-hover table-responsive" >
                                        <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Customer Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th style="width: 10%">Amount</th>
                                            <th>Status</th>
                                            <th width="12%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $invoice)
                                            <tr>
                                                <td>{{$key +1}}</td>
                                                {{--                                                <td>{{$purchase->purchase_no}}</td>--}}
                                                <td>{{$invoice['payment']['customer']['name']}}
                                                    ({{$invoice['payment']['customer']['mobile_no']}}-{{$invoice['payment']['customer']['address']}})
                                                </td>
                                                <td>Invoice No #{{$invoice->invoice_no}}</td>
                                                <td>{{date('d-m-y',strtotime($invoice->date))}}</td>
                                                <td>{{$invoice->description}}</td>
                                                <td>{{$invoice['payment']['total_amount']}}</td>

                                                <td>@if($invoice->status=='0')
                                                        <span style="background-color: brown;padding: 5px;color: white;">Pending</span>
                                                    @elseif($invoice->status=='1')
                                                        <span style="background-color:green;padding: 5px;color:white;">Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{--                                                    <a class="btn btn-sm btn-success" title="edit" href="{{route('purchase-edit',$purchase->id)}}"><i class="fa fa-edit"></i></a>--}}
                                                    @if($invoice->status=='0')
                                                        <a class="btn btn-sm btn-success" id="approve" title="Approve" href="{{route('invoice-approve',$invoice->id)}}"><i class="fa fa-check-circle"></i></a>
                                                        <a class="btn btn-sm btn-danger" id="delete" title="Delete" href="{{route('invoice-delete',$invoice->id)}}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
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
@endsection





