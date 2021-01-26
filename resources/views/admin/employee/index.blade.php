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
                        <li class="breadcrumb-item"><a href="{{route('employee.create')}}">Create</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employee List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Blood</th>
                                        <th>Phone</th>
                                        <th>Join Date</th>
                                        <th>Salary</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($employee as $key=>$row)
                                        @php
                                            $departments = \App\Department::where('id', $row->department_id)->get();
                                            $designations = \App\Designation::where('id', $row->designation)->get();
                                        @endphp
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img src="{{asset('uploads/profile')}}/{{$row->image}}" width="100" alt=""></td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->blood_group}}</td>
                                        <td>{{$row->mobile_number}}</td>
                                        <td>{{$row->join_date}}</td>
                                        <td>{{$row->salary}}</td>
                                        <td>
                                            @foreach($departments as $department)
                                                {{$department -> name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($designations as $designation)
                                                {{$designation -> name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($row->emp_status=='1')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($row->emp_status=='0')
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-xs"
                                               href="{{route('employee.show',[$row->id])}}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-xs" href="#">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-xs" href="#" data-toggle="modal"
                                               data-target="#modal-sm">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </td>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="modal-sm">
                                            <div class="modal-dialog modal-sm">
                                                <form action="{{route('employee.destroy',[$row->id])}}" method="post">
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

