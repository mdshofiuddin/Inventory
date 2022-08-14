@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User </li>
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
                                <a class="btn btn-success btn-sm float-right" href="{{route('user-view')}}"><i class="fa fa-list"></i>User List</a>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <form method="post" action="{{route('user-update',$editData->id)}}" id="myForm">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="usertype">User Role</label>
                                                <select name="usertype" id="usertype" class="form-control">
                                                    <option value="">Select Role</option>
                                                    <option value="Admin" {{($editData->usertype=="Admin")?"selected":""}}>Admin</option>
                                                    <option value="User" {{($editData->usertype=="User")?"selected":""}}>User</option>
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

                                            <div class="form-group col-md-6">
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

