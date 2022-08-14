@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Supplier</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Supplier </li>
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
                                    Add Supplier
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('suppliers-view')}}"><i class="fa fa-plus-circle"></i>Supplier List</a>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{route('suppliers-store')}}" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name" >Name</label>
                                            <input type="text" name="name" id="datepicker" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mobile_no" >Mobile No</label>
                                            <input type="text" name="mobile_no" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email" >Email</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="address" >Address</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label for="image" >Image</label>--}}
{{--                                            <input type="file" name="image" id="image" class="form-control">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <img src="{{url('/upload/no-images.png')}}" id="showImage" style="width: 150px;height: 160px;border: 1px solid black">--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-6" style="padding-top: 30px;">
                                            <input type="submit" value="Submit" class="btn btn-success">
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
                    mobile_no: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    address: {
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



