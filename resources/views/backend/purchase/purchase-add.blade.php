@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Purchase</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Purchase </li>
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
                                    Add Purchase
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('purchase-view')}}"><i class="fa fa-plus-circle"></i>Purchase List</a>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date</label>
                                        <input type="text" name="date" id="date" class="form-control datepicker" placeholder="yyyy-mm-dd" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Purchase No</label>
                                        <input type="text" name="purchase_no" id="purchase_no" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="supplier_id" >Supplier Name</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2 select2bs4">
                                            <option value="">Select Supplier</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="category_id" >Category Name</label>
                                        <select name="category_id" id="category_id" class="form-control select2 select2bs4">
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="product_id" >Product Name</label>
                                        <select name="product_id" id="product_id" class="form-control select2 select2bs4">
                                            <option value="">Select Product</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2" style="padding-top: 30px;">
                                        <a class=" addmoreevent btn btn-success text-white" id="addmoreevent"> <i class="fa fa-plus-circle"></i> Add More</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <form method="post" action="{{route('purchase-store')}}" id="myForm">
                                @csrf
                                <!-- Morris chart - Sales -->
                                    <table class="table table-sm table-bordered table-hover" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th width="7%">Pcs/kg</th>
                                            <th width="10%">Unit Price</th>
                                            <th>Description</th>
                                            <th width="10%">Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="estimated_amount form-control form-control-sm text-right" readonly style="background-color: #D8FDBA">
                                            </td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" id="storeButton">Purchase Store</button>
                                    </div>
                                </form>
                            </div><!-- /.card-body -->
                        <!-- {{--                            card body--}} -->
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

    <script id="document-template" type="text/x-handlebars-template">

        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
            </td>
            <td>
                <input type="text" name="description[]" class="form-control form-control-sm">
            </td>
            <td>
                <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i>
            </td>
        </tr>
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click",".addmoreevent", function() {
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var category_id = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();

                if(date==''){
                    $.notify("Date is required", {globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(purchase_no==''){
                    $.notify("Purchase is required", {globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(supplier_id==''){
                    $.notify("Supplier is required", {globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(category_id==''){
                    $.notify("Category is required", {globalPosition: 'top right',className: 'error'});
                    return false;
                }
                if(product_id==''){
                    $.notify("Product is required", {globalPosition: 'top right',className: 'error'});
                    return false;
                }

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data= {
                    date:date,
                    purchase_no:purchase_no,
                    supplier_id:supplier_id,
                    category_id:category_id,
                    category_name:category_name,
                    product_id:product_id,
                    product_name:product_name
                };
                var html = template(data);
                $("#addRow").append(html);
            });

            $(document).on("click", ".removeeventmore", function (event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on('keyup click','.unit_price,.buying_qty',function(){
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty        = $(this).closest("tr").find("input.buying_qty").val();
                var total      = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });

            // Calculate sum of amount in invoice
            function totalAmountPrice(){
                var sum=0;
                $(".buying_price").each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }
        });
    </script>


    {{--category to sub-category--}}
    <script type="text/javascript">
        $(function(){
            $(document).on('change','#supplier_id',function (){
                var supplier_id = $(this).val();
                $.ajax({
                    url:"{{route('get-category')}}",
                    type:"GET",
                    data:{supplier_id:supplier_id},
                    success:function(data){
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
                        });
                        $('#category_id').html(html);
                    }
                });
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
    <!-- {{--    Validation--}} -->
    <script type="text/javascript">
        $(document).ready(function () {
            // $.validator.setDefaults({
            //     submitHandler: function () {
            //         alert( "Form successful submitted!" );
            //     }
            // });
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    supplier_id: {
                        required: true
                    },
                    unit_id: {
                        required: true,
                    },
                    category_id: {
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





