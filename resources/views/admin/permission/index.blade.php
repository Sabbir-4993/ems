@extends('admin.layouts.master')
@include('admin.layouts.scripts')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <li class="breadcrumb-item">
                        <a href="{{ url()->previous() }}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                    </li>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('permission.create')}}">Create</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
{{--        {{auth()->user()->permission['name']['department']['can-add']}}--}}
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Permission List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center">SN</th>
                                    <th style="width: 15%; text-align: center">Name</th>
                                    <th style="width: 15%; text-align: center">Designation</th>
                                    <th style="width: 40%; text-align: center">Permission</th>
                                    <th style="width: 10%; text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permission as $key=>$row)
                                    @php
                                        $users = \App\User::where('id',$row->user_id)->first();
                                    @endphp
                                    <tr>
                                        <td  style="width: 5%; text-align: center">{{ $key+1 }}</td>
                                        <td style="width: 15%; text-align: center">
                                            {{$users->name}}
                                        </td>
                                        <td style="width: 15%; text-align: center">
                                            {{$row->designation->name}}
                                        </td>
                                        <td style="width: 40%; text-align: center">

                                            {{--Department--}}
                                            @if(isset($row['name']['department']['can-add']))
                                                <span class="badge badge-primary">dept_can_add</span>
                                            @endif

                                            @if(isset($row['name']['department']['can-edit']))
                                                <span class="badge badge-secondary">dept_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['department']['can-delete']))
                                                <span class="badge badge-warning">dept_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['department']['can-view']))
                                                <span class="badge badge-info">dept_can_view</span>
                                            @endif

                                            @if(isset($row['name']['department']['can-list']))
                                                <span class="badge badge-success">dept_can_list</span>
                                            @endif

                                            {{--permission--}}
                                            @if(isset($row['name']['permission']['can-add']))
                                                <span class="badge badge-primary">permission_can_add</span>
                                            @endif

                                            @if(isset($row['name']['permission']['can-edit']))
                                                <span class="badge badge-secondary">permission_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['permission']['can-delete']))
                                                <span class="badge badge-warning">permission_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['permission']['can-view']))
                                                <span class="badge badge-info">permission_can_view</span>
                                            @endif

                                            @if(isset($row['name']['permission']['can-list']))
                                                <span class="badge badge-success">permission_can_list</span>
                                            @endif

                                            {{--Designation--}}
                                            @if(isset($row['name']['designation']['can-add']))
                                                <span class="badge badge-primary">designation_can_add</span>
                                            @endif

                                            @if(isset($row['name']['designation']['can-edit']))
                                                <span class="badge badge-secondary">designation_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['designation']['can-delete']))
                                                <span class="badge badge-warning">designation_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['designation']['can-view']))
                                                <span class="badge badge-info">designation_can_view</span>
                                            @endif

                                            @if(isset($row['name']['designation']['can-list']))
                                                <span class="badge badge-success">designation_can_list</span>
                                            @endif

                                            {{--User--}}
                                            @if(isset($row['name']['user']['can-add']))
                                                <span class="badge badge-primary">user_can_add</span>
                                            @endif

                                            @if(isset($row['name']['user']['can-edit']))
                                                <span class="badge badge-secondary">user_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['user']['can-delete']))
                                                <span class="badge badge-warning">user_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['user']['can-view']))
                                                <span class="badge badge-info">user_can_view</span>
                                            @endif

                                            @if(isset($row['name']['user']['can-list']))
                                                <span class="badge badge-success">user_can_list</span>
                                            @endif

                                            {{--Project--}}
                                            @if(isset($row['name']['project']['can-add']))
                                                <span class="badge badge-primary">project_can_add</span>
                                            @endif

                                            @if(isset($row['name']['project']['can-edit']))
                                                <span class="badge badge-secondary">project_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['project']['can-delete']))
                                                <span class="badge badge-warning">project_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['project']['can-view']))
                                                <span class="badge badge-info">project_can_view</span>
                                            @endif

                                            @if(isset($row['name']['project']['can-list']))
                                                <span class="badge badge-success">project_can_list</span>
                                            @endif

                                            {{--Project Order--}}
                                            @if(isset($row['name']['project_work_order']['can-add']))
                                                <span class="badge badge-primary">work_order_can_add</span>
                                            @endif

                                            @if(isset($row['name']['project_work_order']['can-edit']))
                                                <span class="badge badge-secondary">work_order_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['project_work_order']['can-delete']))
                                                <span class="badge badge-warning">work_order_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['project_work_order']['can-view']))
                                                <span class="badge badge-info">work_order_can_view</span>
                                            @endif

                                            @if(isset($row['name']['project_work_order']['can-list']))
                                                <span class="badge badge-success">work_order_can_list</span>
                                            @endif

                                            {{--Contractors--}}
                                            @if(isset($row['name']['contractors']['can-add']))
                                                <span class="badge badge-primary">contractor_can_add</span>
                                            @endif

                                            @if(isset($row['name']['contractors']['can-edit']))
                                                <span class="badge badge-secondary">contractor_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['contractors']['can-delete']))
                                                <span class="badge badge-warning">contractor_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['contractors']['can-view']))
                                                <span class="badge badge-info">contractor_can_view</span>
                                            @endif

                                            @if(isset($row['name']['contractors']['can-list']))
                                                <span class="badge badge-success">contractor_can_list</span>
                                            @endif

                                            {{--Contractors Bill--}}
                                            @if(isset($row['name']['contractor_bill']['can-add']))
                                                <span class="badge badge-primary">contractor_can_add</span>
                                            @endif

                                            @if(isset($row['name']['contractor_bill']['can-edit']))
                                                <span class="badge badge-secondary">contractor_bill_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['contractor_bill']['can-report']))
                                                <span class="badge badge-warning">contractor_report</span>
                                            @endif

                                            @if(isset($row['name']['contractors']['can-view']))
                                                <span class="badge badge-info">contractor_can_view</span>
                                            @endif

                                            @if(isset($row['name']['contractor_bill']['can-list']))
                                                <span class="badge badge-success">contractor_can_list</span>
                                            @endif

                                            {{--Vendor--}}
                                            @if(isset($row['name']['vendor']['can-add']))
                                                <span class="badge badge-primary">vendor_can_add</span>
                                            @endif

                                            @if(isset($row['name']['vendor']['can-edit']))
                                                <span class="badge badge-secondary">vendor_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['vendor']['can-delete']))
                                                <span class="badge badge-warning">vendor_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['vendor']['can-view']))
                                                <span class="badge badge-info">vendor_can_view</span>
                                            @endif

                                            @if(isset($row['name']['vendor']['can-list']))
                                                <span class="badge badge-success">vendor_can_list</span>
                                            @endif

                                            {{--Vendor Bill--}}
                                            @if(isset($row['name']['vendor_bill']['can-add']))
                                                <span class="badge badge-primary">vendor_bill</span>
                                            @endif

                                            @if(isset($row['name']['vendor_bill']['can-edit']))
                                                <span class="badge badge-secondary">vendor_bill_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['vendor_bill']['can-report']))
                                                <span class="badge badge-warning">vendor_report</span>
                                            @endif

                                            @if(isset($row['name']['vendor_bill']['can-view']))
                                                <span class="badge badge-info">vendor_bill_view</span>
                                            @endif

                                            @if(isset($row['name']['vendor_bill']['can-list']))
                                                <span class="badge badge-success">vendor_bill_list</span>
                                            @endif

                                            {{--material--}}
                                            @if(isset($row['name']['material']['can-add']))
                                                <span class="badge badge-primary">material_can_add</span>
                                            @endif

                                            @if(isset($row['name']['material']['can-edit']))
                                                <span class="badge badge-secondary">material_can_edit</span>
                                            @endif

                                            @if(isset($row['name']['material']['can-delete']))
                                                <span class="badge badge-warning">material_can_delete</span>
                                            @endif

                                            @if(isset($row['name']['material']['can-view']))
                                                <span class="badge badge-info">material_can_view</span>
                                            @endif

                                            @if(isset($row['name']['material']['can-list']))
                                                <span class="badge badge-success">material_can_list</span>
                                            @endif


                                        </td>
                                        <td style="width: 10%; text-align: center" class="text-center">
                                            <a class="btn btn-info btn-xs" href="{{route('permission.edit',[$row->id])}}">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-xs" href="{{route('permission.destroy',[$row->id])}}" data-toggle="modal" data-target="#modal-sm">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </td>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="modal-sm">
                                            <div class="modal-dialog modal-sm">
                                                <form action="{{route('permission.destroy',[$row->id])}}" method="post">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Confirm!!</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Do you Want to Delete ?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal End -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('css')
    @yield('datatable_css')
@endsection

@section('script')
    @yield('datatable_js')
@endsection
