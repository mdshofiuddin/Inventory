@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Password</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Password </li>
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
                                    Edite Password
                                </h3>
{{--                                <a class="btn btn-success btn-sm float-right" href="{{route('user-view')}}"><i class="fa fa-list"></i>User List</a>--}}

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <form method="post" action="{{route('profile-password-update')}}" id="myForm">
                                        @csrf
                                        <div class="form-row">
{{--                                        <div class="form-row">--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <label for="usertype">User Role</label>--}}
{{--                                                <select name="usertype" id="usertype" class="form-control">--}}
{{--                                                    <option value="">Select Role</option>--}}
{{--                                                    <option value="Admin">Admin</option>--}}
{{--                                                    <option value="User">User</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <label for="name">Name</label>--}}
{{--                                                <input type="text" name="name" class="form-control">--}}
{{--                                                <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <label for="email">email</label>--}}
{{--                                                <input type="email" name="email" class="form-control">--}}
{{--                                                <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>--}}
{{--                                            </div>--}}
                                            <div class="form-group col-md-4">
                                                <label for="old_password"> Old Password</label>
                                                <input type="password" name="old_password" id="old_password" class="form-control">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="new_password"> New Password</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="confirm_new_password">Confirm New Password</label>
                                                <input type="password" name="confirm_new_password" class="form-control">
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

                    old_password: {
                        required: true
                    },
                    new_password: {
                        required: true,
                        minlength: 6
                    },
                   confirm_new_password: {
                        required: true,
                        equalTo: '#new_password'
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {

                    old_password: {
                        required: "Please provide current password",
                        minlength: "Your password must be at least 6 characters"
                    },

                    new_password: {
                        required: "Please provide new password",
                        minlength: "Your password must be at least 6 characters"
                    },
                    confirm_new_password: {
                        required: "Please provide confirm password",
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

