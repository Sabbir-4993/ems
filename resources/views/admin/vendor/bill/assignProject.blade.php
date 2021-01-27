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
                        <li class="breadcrumb-item"><a href="{{route('vendorAssignProject.view')}}">Assign Project</a></li>
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
        <form action="{{route('vendorAssignProject.store')}}" method="post">
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
                                use App\Category;use App\Project;use App\Vendor;
                                $categories = Category::all();
                                $projects = Project::all();
                                $vendors = Vendor::all();
                            @endphp
                            <div class="form-group">
                                <label class="col-form-label">Select Vendor </label>
                                <select class="custom-select" name="vendor_name">
                                    <option selected="selected" disabled>Select Vendor </option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->vendor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <!-- Date -->
                            <div class="form-group">
                                <label for="exampleInputName">Select Project</label>
                                <select name="project_name" id="project" class="form-control">
                                    <option selected disabled >Select Project</option>
                                    @foreach(\App\Project::all() as $projects)
                                       <option value="{{$projects->id}}">{{$projects->project_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <!-- /.form-group -->
                                <!-- Date -->
                                <div class="form-group">
                                    <label for="title">Select Work Order:</label>
                                    <select name="project_work_order" id="work-order" class="form-control" required>
                                    </select>
                                </div>
                            <!-- /.form-group -->
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
                                    <label for="exampleDepartmentDetails">PI No</label>
                                    <input class="form-control @error('pi_number') is-invalid @enderror" name="pi_number" type="text" placeholder="">
                                    @error('pi_number')
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
    <script>
        // for project
        $(document).ready(function () {

            $('#project').on('change',function(e) {

                var project_id = e.target.value;
                $.ajax({

                    url:"{{ route('requisition.getWorkNo')}}",
                    type:"POST",
                    data: {
                        project_id: project_id,
                        _token: '{{csrf_token()}}',
                    },
                    success:function (data) {
                        $('#work-order').empty();
                        $.each(data, function(i, value) {
                            $('#work-order').append('<option value="'+value.id+'">'+value.work_order+'</option>');
                        });
                    }
                })
            });
        });
        // for product
    </script>
@endsection