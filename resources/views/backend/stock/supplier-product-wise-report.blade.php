
@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Supplier/Product Wise Stock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product </li>
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
                                <a class="btn btn-success btn-sm float-right" target="_blank" href="{{route('stock-report-pdf')}}"><i class="fa fa-download"></i>Download Product</a>

                            </div><!-- /.card-header -->

                            <div class="card-body">
{{--                                <div class="tab-content p-0">--}}
                                    <!-- Morris chart - Sales -->
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <strong>Supplier wise report</strong>
                                            <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value">
                                            <strong>Product wise report</strong>
                                            <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                                        </div>
                                    </div>
                                    <div class="show_supplier" style="display: none;">
                                        <form method="get" id="supplierWise" action="{{route('stock-supplier-wise-pdf')}}" target="_blank">
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <label>Supplier Name</label>
                                                    <select name="supplier_id" class="form-control select2 select2bs4">
                                                        <option value="">Select Supplier</option>
                                                        @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4" style="padding-top: 32px;">
                                                    <button type="submit" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="show_product" style="display: none;">
                                        <form method="get" id="productWise" action="{{route('stock-product-wise-pdf')}}" target="_blank">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="category_id" >Category Name</label>
                                                    <select name="category_id" id="category_id" class="form-control form-control-sm select2 select2bs4">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="product_id" >Product Name</label>
                                                    <select name="product_id" id="product_id" class="form-control form-control-sm select2 select2bs4">
                                                        <option value="">Select Product</option>
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
           if (search_value == 'supplier_wise'){
               $('.show_supplier').show();
           }else {
               $('.show_supplier').hide();
           }
           if(search_value == 'product_wise'){
               $('.show_product').show();
           }else {
               $('.show_product').hide();
           }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#supplierWise').validate({

                // ignore:[];
                // errorPlacement: function (error, element){
                //     if (element.attr("name") == "supplier_id"){
                //         error.insertAfter(element.next());
                //     }else{
                //error.insertAfter(element)
                //     }
                // },
                // errorClass: 'text-danger',
                // validClass: 'text-success',

                rules: {
                    supplier_id: {
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
            $('#productWise').validate({

                rules: {
                    category_id: {
                        required: true
                    },
                    product_id: {
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


