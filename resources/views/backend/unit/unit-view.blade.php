@extends('backend.layout.master')

@section('home-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Unit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Unit </li>
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
                                    Unit List
                                </h3>
                                <a class="btn btn-success btn-sm float-right" href="{{route('unites-add')}}"><i class="fa fa-plus-circle"></i>Add Unit</a>

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <table id="example1" class="table table-sm table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Unit Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $unit)
                                            <tr>
                                                <td>{{$key +1}}</td>
                                                <td>{{$unit->name}}</td>
{{--                                                <td>{{$customer->mobile_no}}</td>--}}
{{--                                                <td>{{$customer->email}}</td>--}}
{{--                                                <td>{{$customer->address}}</td>--}}

                                                {{$count_unit = \App\Model\Product::where('unit_id',$unit->id)->count()}}

                                                <td>
                                                    <a class="btn btn-sm btn-dark" title="edit" href="{{route('unites-edit',$unit->id)}}"><i class="fa fa-edit"></i></a>
                                                    @if($count_unit<1)
                                                    <a class="btn btn-sm btn-dark" id="delete" title="edit" href="{{route('unites-delete',$unit->id)}}"><i class="fa fa-trash"></i></a>
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


