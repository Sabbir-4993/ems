@extends('admin.layouts.master')

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
                        <li class="breadcrumb-item"><a href="{{url('/project')}}">Project</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <form action="{{route('department.store')}}" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Add New Project</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputProjectName">Project Name</label>
                                <input class="form-control @error('project_name') is-invalid @enderror" name="project_name" type="text" placeholder="Enter Project Name">
                                @error('project_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="exampleInputCompanyName">Company / Client Name</label>
                                <input class="form-control @error('company_name') is-invalid @enderror" name="company_name" type="text" placeholder="Enter Company/Client Name">
                                @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputWorkOrder">Ref./Work Order</label>
                                <input class="form-control @error('project_ref') is-invalid @enderror" name="project_ref" type="text" placeholder="Enter Reference Number">
                                @error('project_ref')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="exampleInputAddress">Project Address</label>
                                <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" placeholder="Enter Address">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Start Date:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>End Date:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Project Status</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Running</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">

                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
