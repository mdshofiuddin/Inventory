
@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Customer Wise Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Custome </li>
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
                                    Select Criteria
                                </h3>
                        
                            </div><!-- /.card-header -->

                            <div class="card-body">
                            {{--                                <div class="tab-content p-0">--}}
                            <!-- Morris chart - Sales -->
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <strong>Customer wise credit report</strong>
                                        <input type="radio" name="customer_wise_report" value="customer_wise_credit" class="search_value">
                                        <strong>Customer wise paid report</strong>
                                        <input type="radio" name="customer_wise_report" value="customer_wise_paid" class="search_value">
                                    </div>
                                </div>
                                <div class="show_credit" style="display: none;">
                                    <form method="get" id="crditForm" action="{{route('customers-credit-report')}}">
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <label>Customer Name</label>
                                                <select name="customer_id" class="form-control select2 select2bs4">
                                                    <option value="">Select Customer</option>
                                                    @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}} ({{$customer->mobile_no}}-{{$customer->address}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4" style="padding-top: 32px;">
                                                <button type="submit" class="btn btn-success">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="show_paid" style="display: none;">
                                    <form method="get" id="paidForm" action="{{route('customers-paid-report')}}">
                                        <div class="form-row">
                                           <div class="col-md-8">
                                                <label>Customer Name</label>
                                                <select name="customer_id" class="form-control select2 select2bs4">
                                                    <option value="">Select Customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}} ({{$customer->mobile_no}}-{{$customer->address}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2" style="padding-top: 32px;">
                                                <button type="submit" class="btn btn-success">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    {{--                        </div>--}}
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
        $(document).on('change','.search_value',function (){
            var search_value = $(this).val();
            if (search_value == 'customer_wise_credit'){
                $('.show_credit').show();
            }else {
                $('.show_credit').hide();
            }
            if(search_value == 'customer_wise_paid'){
                $('.show_paid').show();
            }else {
                $('.show_paid').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#crditForm').validate({

                rules: {
                    customer_id: {
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
    </script> <script type="text/javascript">
        $(document).ready(function () {
            $('#paidForm').validate({

                rules: {
                    customer_id: {
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


    <script type="text/javascript">
        $(function(){
            $(document).on('change','#category_id',function (){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{route('get-product')}}",
                    type:"GET",
                    data:{category_id:category_id},
                    success:function(data){
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                });
            });
        });

    </script>
@endsection



