@extends('admin.layouts.master');

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
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="sendFormData">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card card-purple">
                            <div class="card-header">
                                <h3 class="card-title">Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        use App\Vendor;
                                        $vendors = Vendor::all();
                                    @endphp
                                    <div class="col-md-4">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="exampleInputName">Select Project</label>
                                            <select name="project_id" id="project" class="form-control">
                                                <option selected disabled >Select Project</option>
                                                @foreach(\App\Project::all() as $projects)
                                                    <option value="{{$projects->id}}">{{$projects->project_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="title">Select Work Order:</label>
                                            <select name="work_order" id="work-order" class="form-control" required>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="end_date" class="exampleInputName">Select Vendor</label>
                                            <select class="form-control" name="vendor_name">
                                                <option selected="selected" disabled>Select Vendor </option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}">{{$vendor->vendor_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="end_date" class="col-form-label">From</label>
                                            <input class="form-control" type="date"  id="start_date" name="from">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="end_date" class="col-form-label">To</label>
                                            <input class="form-control" type="date"  id="end_date" name="to">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="row card-footer">
                                <div class="col-12">
                                    <input type="submit" id="submit" value="Search" class="btn btn-success float-right">
                                </div>
                            </div>
                        </div> <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Billing Report </h3>
                        <div class="m-3 dropdown float-right">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Select Day
                            </button>
                            <div class="dropdown-menu ">
                                <button class="dropdown-item" id="today" >Today</button>
                                <button class="dropdown-item" id="week">Last 7 Day</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="display" >
                            <thead>
                            <tr>
                                <th>Project</th>
                                <th>Vendor Name</th>
                                <th>Work Order</th>
                                <th>PI NO</th>
                                <th>Bill No.</th>
                                <th> Amount</th>
                                <th> Method</th>
                                <th> Details</th>
                                <th> Date</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/af-2.3.5/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.7/sb-1.0.1/datatables.min.css"/>
@endsection

@section('script')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/af-2.3.5/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.7/sb-1.0.1/datatables.min.js"></script>
    <script>

        $(document).ready( function () {
            $('#example1').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
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
        //search report data
        $(document).ready(function(e){
            $("#sendFormData").on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('action', 'savadata');
                $.ajax({
                    type: 'POST',
                    url: '{{route('vendor.today.search')}}',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                        $("#sendFormData").trigger("reset"); //reset form
                        var table;
                        table = $('#example1').DataTable();
                        if(data!='') {
                            $.each(data, function(i, item) {
                                table.row.add([
                                    data[i].project_name,
                                    data[i].vendor_name,
                                    data[i].work_order,
                                    data[i].pi_number,
                                    data[i].billing_no,
                                    data[i].billing_amount,
                                    data[i].billing_method,
                                    data[i].billing_details,
                                    data[i].billing_date,
                                ]);
                            });
                        }
                        else {
                            $('#example1').html('<h3>No Data are available</h3>');
                        }
                        table.draw();

                    }
                });
            });
        });
        //today report data
        $(document).ready(function(){
            $("#today").on('click', function(e){
                $.ajax({
                    type: 'get',
                    url: '{{route('vendor.today')}}',
                    success: function(data){
                        var table;
                        table = $('#example1').DataTable();
                        table.clear();
                        if(data!='') {
                            $.each(data, function(i, item) {
                                table.row.add([
                                    data[i].project_name,
                                    data[i].vendor_name,
                                    data[i].work_order,
                                    data[i].pi_number,
                                    data[i].billing_no,
                                    data[i].billing_amount,
                                    data[i].billing_method,
                                    data[i].billing_details,
                                    data[i].billing_date,
                                ]);
                            });
                        }
                        else {
                        }
                        table.draw();

                    }
                });
            });
        });
        //Weekly Bill
        $(document).ready(function(){
            $("#week").on('click', function(e){
                $.ajax({
                    type: 'get',
                    url: '{{route('vendor.week')}}',
                    success: function(data){
                        var table;
                        table = $('#example1').DataTable();
                        table.clear();
                        if(data!='') {
                            $.each(data, function(i, item) {
                                table.row.add([
                                    data[i].project_name,
                                    data[i].vendor_name,
                                    data[i].work_order,
                                    data[i].pi_number,
                                    data[i].billing_no,
                                    data[i].billing_amount,
                                    data[i].billing_method,
                                    data[i].billing_details,
                                    data[i].billing_date,
                                ]);
                            });
                        }
                        else {
                        }
                        table.draw();

                    }
                });
            });
        });

    </script>
@endsection
