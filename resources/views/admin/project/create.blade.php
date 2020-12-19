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
        <form action="{{route('project.store')}}" method="post">
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
                                <label for="exampleInputCompanyEmail">Company Email</label>
                                <input class="form-control @error('company_email') is-invalid @enderror" name="company_email" type="text" placeholder="Enter Company Email">
                                @error('company_email')
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
                                <label for="exampleInputCompanyName">Company / Client Name</label>
                                <input class="form-control @error('company_name') is-invalid @enderror" name="company_name" type="text" placeholder="Enter Company/Client Name">
                                @error('company_name')
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
                            <div class="form-group">
                                <label for="exampleInputAddress">Contact Number</label>
                                <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" placeholder="Enter Number">
                                @error('phone')
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
                                <label>Project Start:</label>
                                <div class="input-group">
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" placeholder="MM/DD/YY" class="form-control datetimepicker-input" data-target="#reservationdate" name="project_start"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Project End:</label>
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="text" placeholder="MM/DD/YY" class="form-control datetimepicker-input" data-target="#reservationdate1" name="project_end"/>
                                    <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Project Status</label>
                                <select class="form-control" style="width: 100%;" name="status" required="">
                                    <option selected="selected">Select Status</option>
                                    <option value="1">Running</option>
                                    <option value="0">Completed</option>
                                </select>
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
        <section class="content">
            <form class="row">
                <div class="col-md-6">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
                        </div>
                    @endif
                    <form action="{{route('project.store')}}" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
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
                                    <label for="inputDescription">Project Description</label>
                                    <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                </div>
                                <!-- /.form-group -->
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
                                    <label for="exampleInputCompanyEmail">Company Email</label>
                                    <input class="form-control @error('company_email') is-invalid @enderror" name="company_email" type="text" placeholder="Enter Company Email">
                                    @error('company_email')
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
                                <div class="form-group">
                                    <label for="exampleInputAddress">Contact Number</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" placeholder="Enter Number">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputCompanyName">Client Company</label>
                                    <input class="form-control @error('company_name') is-invalid @enderror" name="company_name" type="text" placeholder="Enter Company/Client Name">
                                    @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="inputProjectLeader">Project Leader</label>
                                    <input type="text" id="inputProjectLeader" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select id="inputStatus" class="form-control custom-select">
                                        <option selected disabled>Select one</option>
                                        <option value="0">On Running</option>
                                        <option value="1">On Hold</option>
                                        <option value="2">Canceled</option>
                                        <option value="3">Success</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Budget</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">Estimated budget</label>
                                        <input type="number" id="inputEstimatedBudget" class="form-control">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="inputSpentBudget">Total amount spent</label>
                                        <input type="number" id="inputSpentBudget" class="form-control">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Estimated project duration</label>
                                        <input type="number" id="inputEstimatedDuration" class="form-control">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Project Start:</label>
                                        <div class="input-group">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" placeholder="MM/DD/YY" class="form-control datetimepicker-input" data-target="#reservationdate" name="project_start"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                        <div class="form-group">
                                            <label>Project End:</label>
                                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                                <input type="text" placeholder="MM/DD/YY" class="form-control datetimepicker-input" data-target="#reservationdate1" name="project_end"/>
                                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 card-footer">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
