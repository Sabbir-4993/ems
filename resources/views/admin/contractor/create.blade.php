
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
                        <li class="breadcrumb-item"><a href="{{url('/contractor')}}">Contractor</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- page title area end -->

    <!-- Main content -->
    <section id="" class="content">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <form action="{{route('contractors.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Contractor Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="contractor_name" class="col-form-label">Contractor Name</label>
                                <input class="form-control @error('contractor_name') is-invalid @enderror"
                                       name="contractor_name" type="text" placeholder="Enter Contractor Name">
                                @error('contractor_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="contractor_number">Contractor Number</label>
                                <input class="form-control @error('contractor_number') is-invalid @enderror"
                                       name="contractor_number" type="text" placeholder="Enter Contractor Number">
                                @error('contractor_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
{{--                                @php--}}
{{--                                    $categories = \App\Models\Category::all();--}}
{{--                                    $projects = \App\Models\Project::all();--}}
{{--                                @endphp--}}
                                <label class="col-form-label">Contractor Type</label>
                                <select class="custom-select" name="contractor_type">
                                    <option selected="selected">Select Contractor Type</option>
                                    <option value="1">Contractor</option>
                                    {{--@foreach($categories as $category)--}}
{{--                                        <option value="{{$category->id}}">{{$category->cat_name}}</option>--}}
{{--                                    @endforeach--}}

                                </select>
                            </div>

                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="assign_by">Reference & Assign By </label>
                                <input class="form-control @error('assign_by') is-invalid @enderror" name="assign_by"
                                       type="text" placeholder="Enter Reference & Assign By">
                                @error('assign_by')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Project Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {{--  @php--}}
                                {{--$categories = \App\Models\Category::all();--}}
                                {{--$projects = \App\Models\Project::all();--}}
                                {{--  @endphp--}}
                                <label class="col-form-label">Project Name</label>
                                <select class="custom-select" name="project_name">
                                    <option selected="selected">Select Project </option>
                                    {{--  @foreach($categories as $category)--}}
                                    {{-- <option value="{{$category->id}}">{{$category->cat_name}}</option>--}}
                                     <option value="1">EGMC</option>
                                    {{-- @endforeach--}}

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assign_date" class="col-form-label"> Assign Date</label>
                                <input class="form-control" type="date"  id="assign_date" name="assign_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="col-form-label">End Date</label>
                                <input class="form-control" type="date"  id="end_date" name="end_date">
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
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection

@section('script')
@endsection
