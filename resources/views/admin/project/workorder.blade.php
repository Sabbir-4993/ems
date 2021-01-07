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

        <form action="#" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Assign Work Order in Project</h3>
                </div>
                <div class="card-body">
                    @php
                        use App\Project;
                        $projects = Project::all();
                    @endphp
                    <div class="form-group">
                        <label for="exampleInpute">Select Project</label>
                        <select class="custom-select" name="project_name" required="">
                            <option selected="selected" disabled>Select  Project</option>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->project_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="example">Work Order Number</label>
                        <input class="form-control @error('work_order') is-invalid @enderror" name="work_order" type="text" placeholder="" required="">
                        @error('work_order')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">WO. Status</label>
                        <select id="inputStatus" class="form-control custom-select" name="status"
                                required>
                            <option selected disabled>Select Status</option>
                            <option value="0">On Running</option>
                            <option value="1">On Hold</option>
                            <option value="2">Canceled</option>
                            <option value="3">Complete</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Details</label>
                        <textarea name="details" id="details" cols="10" class="form-control" rows="5" required=""></textarea>
                    </div>
                    <div class="form-group" disabled="">
                        <label for="inputStatus">Created By</label>
                        <input class="form-control" disabled name="created_by" type="text" value="{{Auth()->user()->name}}">
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">
                        Submit
                    </button>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </div>
    <!-- /.content -->
@endsection
