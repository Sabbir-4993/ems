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
                        <li class="breadcrumb-item"><a href="{{route('requisition.pending')}}">Requisition</a></li>
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
                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="exampleInputRequisition">Requisition No.</label>--}}
                            {{--                                <input type="text" name="req_no" class="form-control" id="exampleInputRequisition" required="" placeholder="Enter Requisition No.">--}}
                            {{--                            </div>--}}
                            <div class="form-group">
                                <label for="exampleInputName">Select PCO</label>
                                <select name="requisition_by" id="requisition_by" class="form-control" required>
                                    @php
                                        $designation =  \App\Designation::where('name','Project Coordinator')->first();
                                    @endphp
                                    <option selected disabled >Select PCO</option>
                                    @foreach(\App\User::where('designation',$designation->id)->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
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
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Particulars</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Remarks</th>
                                        <th><a href="#" class="btn btn-primary addRow" id="addRow"><i class="fa fa-plus-square"></i></a></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width:1%">1</td>
                                        <td style="width:50%"><input name="particular[]" id="particular" class="form-control row-cols-xl-4" required></td>
                                        <td style="width:10%"><input name="quantity[]" class="form-control" type="text" ></td>
                                        <td style="width:10%"><input name="unit[]" class="form-control" type="text" ></td>
                                        <td style="width:30%"><input name="remarks[]" class="form-control" type="text" ></td>
                                        <td><a href="#" class="btn btn-danger remove" id="remove"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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
        $('#addRow').on('click', function (){
            addRow();
        });
        function addRow(){
            var rowCount = $('tbody tr').length + 1;
            var th='<tr>'+
                ' <td style="width:1%">'+rowCount+'</td>'+
                '<td style="width:50%"><input name="particular[]" id="particular" class="form-control" required></td>'+
                '<td style="width:10%"><input name="quantity[]" class="form-control" type="text"></td>'+
                '<td style="width:10%"><input name="unit[]" class="form-control" type="text"></td>'+
                '<td style="width:30%"><input name="remarks[]" class="form-control" type="text"></td>'+
                '<td><a href="#" class="btn btn-danger remove" id="remove"><i class="fa fa-trash"></i></a></td>'+
                '</tr>';
            $('tbody').append(th);
        };
        $(document).on('click', '#remove', function() {
            var last=$('tbody tr').length;
            if(last==1){
                alert("Can't Delete the last Particulars form");
            }else {
                $(this).parent().parent().remove();
                last--;
            }
        });
    </script>

@endsection
