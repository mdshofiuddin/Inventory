@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile </li>
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
                                    Edit User
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('profile-view')}}"><i class="fa fa-list"></i>Your profile</a>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <form method="post" action="{{route('profile-update')}}" id="myForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="gender">User Role</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" {{($editData->gender=="Male")?"selected":""}}>Male</option>
                                                    <option value="Female" {{($editData->gender=="Female")?"selected":""}}>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="name">Name</label>
                                                <input type="text" value="{{$editData->name}}" name="name" class="form-control">
                                                <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email">email</label>
                                                <input type="email" value="{{$editData->email}}" name="email" class="form-control">
                                                <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" value="{{$editData->moblie}}" name="moblie" class="form-control">
                                                <font style="color: red">{{($errors->has('moblie'))?($errors->first('moblie')):''}}</font>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="adress">Address</label>
                                                <input type="text" value="{{$editData->address}}" name="address" class="form-control">
                                                <font style="color: red">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <img id="showImage" src="{{(!empty($editData->image))?url('/upload/user-images/'.$editData->image):url('/upload/no-images.png')}}" style="width: 150px; height: 160px; border: 1px solid #000;">
                                            </div>

                                            <div class="form-group col-md-6" style="padding-top: 30px;">
                                                <input type="submit" value="Update" class="btn btn-success">
                                            </div>
                                        </div>
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

    <script type="text/javascript">
        $(document).ready(function () {
            // $.validator.setDefaults({
            //     submitHandler: function () {
            //         alert( "Form successful submitted!" );
            //     }
            // });
            $('#myForm').validate({
                rules: {
                    usertype: {
                        required: true
                    },
                    name: {
                        required: true
                    },

                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password2: {
                        required: true,
                        equalTo: '#password'
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    usertype: {
                        required: "Please select a option",
                    },
                    name: {
                        required: "Please enter your name",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password2: {
                        required: "Please provide a confirm password",
                        equalTo: "Does not match Confirm Password"
                    },
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

