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
                        <li class="breadcrumb-item"><a href="{{route('assignProject.view')}}">Assign Project</a></li>
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
        <form action="{{route('assignProject.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                use App\Category;use App\Contractor;use App\Project;
                                $categories = Category::all();
                                $projects = Project::all();
                                $contractors = Contractor::all();
                            @endphp
                            <div class="form-group">
                                <label class="col-form-label">Contractor Select</label>
                                <select class="custom-select" name="contractor_name">
                                    <option selected="selected" disabled>Select Contractor </option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{$contractor->id}}">{{$contractor->contractor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Project Select</label>
                                <select class="custom-select" name="project_name">
                                    <option selected="selected" disabled>Select  Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->project_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Category Select</label>
                                <select class="custom-select" name="category_name">
                                    <option selected="selected" disabled>Select Contractor Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
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
                                <label for="assign_date" class="col-form-label"> Assign Date</label>
                                <input class="form-control" type="date"  id="assign_date" name="assign_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="col-form-label">End Date</label>
                                <input class="form-control" type="date"  id="end_date" name="end_date">
                            </div>
                            <div class="form-group">
                                    <label for="exampleDepartmentDetails">Work Order No</label>
                                    <input class="form-control @error('work_order') is-invalid @enderror" name="work_order" type="text" placeholder="">
                                    @error('work_order')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="total_payable" class="col-form-label">Total Payable</label>
                                <input class="form-control" type="text" id="total_payable" name="total_payable">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row card-footer">
                <div class="col-12">
                    <a href="{{route('assignProject.view')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection

@section('script')
@endsection
