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
                        <li class="breadcrumb-item"><a href="{{route('requisition.show')}}">Requisition</a></li>
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
        @if(Session::has('message1'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> {{Session::get('message1')}}</h5>
                </div>
        @endif
        <form action="{{route('requisition.store')}}" method="post">
           @csrf
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Requisition Added</h3>
                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">Select Project</label>
                                <select name="project_id" id="project" class="form-control">
                                    <option selected disabled >Select Project</option>
                                    @foreach(\App\Project::all() as $projects)
                                        <option value="{{$projects->id}}">{{$projects->project_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Select Work Order:</label>
                                <select name="work_order" id="work-order" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputRequisition">Requisition No.</label>
                                <input type="text" name="req_no" class="form-control" id="exampleInputRequisition" required="" placeholder="Enter Requisition No.">
                            </div>

                        </div>
                        <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-8">
                <!-- Form Element sizes -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Requisition Details</h3>
                    </div>
                    <div class="card-body">
                       <div class="form-group">
                           <form>
                               <div class="form-group">
                                   <label for="exampleInputName">Select Material Category</label>
                                   <select name="category" id="category" class="form-control">
                                       <option selected  >Select Material Category</option>
                                       @foreach(\App\MaterialCategory::orderby('name','asc')->get() as $category)
                                           <option value="{{$category->id}}">{{$category->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label for="title">Select Material:</label>
                                   <select name="particular[]" id="particular" class="form-control" required>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label for="title">Product Quantity:</label>
                                   <input type="text" id="quantity" name="quantity[]" placeholder="Enter Product Quantity" class="form-control" >
                               </div>

                               <div class="form-group">
                                   <label for="title">Remarks:</label>
                                   <input type="text" id="remarks" name="remarks[]" placeholder="Enter  Remarks" class="form-control " >
                               </div>
                           </form>
                       </div>
                    </div>
                    <div class="form-group container">
                        <button type="button" id="add-row" class="btn btn-info float-right" >Add Row</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group table-responsive p-0">
                            <label for="exampleInputmaterial">Requisition Details</label>
                                <table class="table table-bordered" id="tbl_posts">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Remarks </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            <button type="button" id="delete-row" class=" btn btn-danger">Delete Row</button>
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
    <!-- /.content -->
@endsection
@section('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    @endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#add-row").click(function(){
                var particular = $("#particular").val();
                var quantity = $("#quantity").val();
                var remarks = $("#remarks").val();
                var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + particular + "</td><td>" + quantity + "</td><td>" + remarks + "</td></tr>";
                $("table tbody").append(markup);
            });

            // Find and remove selected table rows
            $("#delete-row").click(function(){
                $("table tbody").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("tr").remove();
                    }
                });
            });
        });
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
        $(document).ready(function () {

            $('#category').on('change',function(e) {

                var cat_id = e.target.value;
                $.ajax({
                    url:"{{ route('requisition.getMaterial')}}",
                    type:"POST",
                    data: {
                        cat_id: cat_id,
                        _token: '{{csrf_token()}}',
                    },
                    success:function (data) {
                        $('#particular').empty();
                        $.each(data, function(i, value) {
                            $('#particular').append('<option value="'+value.id+'">'+value.material_name+'</option>');
                        });
                    }
                })
            });
        });

    </script>

@endsection
