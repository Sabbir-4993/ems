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
    <section id="" class="content">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <form action="#" method="post">
            @csrf
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Employee Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form >
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select id="inputStatus" class="form-control custom-select" name="department_id"
                                            required="">
                                        <option value="" selected disabled>Select Employee</option>
                                        @foreach(\App\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Designation</label>
                                    <select class="form-control" name="designation" id="" required="">
                                        <option value="" selected disabled>Select Project</option>

                                        @foreach(\App\Project::all() as $project)
                                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <!-- Form Element sizes -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Work  Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="exampleInputName" required=""
                                       placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="exampleInputName" required=""
                                       placeholder="Enter First Name">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
                <div class="col-md-12">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info float-right">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

