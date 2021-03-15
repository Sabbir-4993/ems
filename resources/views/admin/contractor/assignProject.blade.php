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
                                <a class="btn btn-info btn-sm float-right"  href="#" data-toggle="modal"  data-target="#modal-sm" >
                                    <i class="fas fa-plus"></i>
                                    Add Category
                                </a>
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
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-m">
            <form action="{{route('category.store')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="card-title">Add Contractor  Category</h3>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInputDepartmentName">Category Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                        <br>

                        <label for="exampleDepartmentDetails">Category Details</label>
                        <textarea name="description" class="form-control" cols="30" rows="5" id=""></textarea>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add Category</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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
