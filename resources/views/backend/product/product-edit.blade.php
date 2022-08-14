@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Product</h1>
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
                                    Edit Product
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('products-view')}}"><i class="fa fa-plus-circle"></i>Product List</a>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{route('products-update',$editData->id)}}" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name" >Supplier Name</label>
                                            <select name="supplier_id" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}" {{($editData->supplier_id==$supplier->id)? 'selected':''}}>{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="name" >Unit Name</label>
                                            <select name="unit_id" class="form-control">
                                                <option value="">Select Unit</option>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}" {{($editData->unit_id==$unit->id)? 'selected':''}}>{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="category_id" >Category Name</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{($editData->category_id==$category->id)? 'selected':''}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="name" >Product Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                      <!--   <div class="form-group col-md-3">
                                            <label for="name" >Unit Price</label>
                                            <input type="text" name="unit_price" class="form-control">
                                        </div>
 -->

                                        {{--                                        <div class="form-group col-md-4">--}}
                                        {{--                                            <label for="image" >Image</label>--}}
                                        {{--                                            <input type="file" name="image" id="image" class="form-control">--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="form-group col-md-2">--}}
                                        {{--                                            <img src="{{url('/upload/no-images.png')}}" id="showImage" style="width: 150px;height: 160px;border: 1px solid black">--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group col-md-6" style="padding-top: 30px;">
                                            <input type="submit" value="Update" class="btn btn-success">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{--                            card body--}}
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

    {{--    Validation--}}

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



@endsection





