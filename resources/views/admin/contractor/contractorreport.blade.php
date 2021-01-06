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
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Report</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php
                                    use App\Category;use App\Contractor;use App\Project;
                                    $categories = Category::all();
                                    $projects = Project::all();
                                    $contractors = Contractor::all();
                                @endphp
                                <div class="col-md-4">
                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="end_date" class="col-form-label">Project Name</label>
                                        <select class="custom-select" name="project_name">
                                            <option selected="selected" disabled>Select  Project</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}">{{$project->project_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-4">
                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="end_date" class="col-form-label">Project Name</label>
                                        <select class="custom-select" name="project_name">
                                            <option selected="selected" disabled>Select  Project</option>
                                            @foreach($projects as $workorder)
                                                    <option>{{$workorder->id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-4">
                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="end_date" class="col-form-label">Contractor</label>
                                        <select class="custom-select" name="contractor_name">
                                            <option selected="selected" disabled>Select Contractor </option>
                                            @foreach($contractors as $contractor)
                                                <option value="{{$contractor->id}}">{{$contractor->contractor_name}}</option>
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
                                <input type="submit" value="Search" class="btn btn-success float-right">
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Contractor List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <td>Project</td>
                                    <td>Contractor</td>
                                    <th>Work Order</th>
                                    <th>Bill No.</th>
                                    <th>Billing Amount</th>
                                    <th>Billing Method</th>
                                    <th>Billing Details</th>
                                    <th>Billing Date</th>
                                </tr>
                                </thead>
                                @php
                                    $billhistory = \Illuminate\Support\Facades\DB::table('billing_histories')->get();
                                @endphp
                                @foreach($billhistory as $key=>$row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$row->project_work_no}}</td>
                                        <td>{{$row->billing_no}}</td>
                                        <td>{{$row->billing_amount}}</td>
                                        <td>{{$row->billing_method}}</td>
                                        <td>{{$row->billing_details}}</td>
                                        <td>{{$row->billing_date}}</td>
                                    </tr>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <td>Project</td>
                                    <td>Contractor</td>
                                    <th>Work Order</th>
                                    <th>Bill No.</th>
                                    <th>Billing Amount</th>
                                    <th>Billing Method</th>
                                    <th>Billing Details</th>
                                    <th>Billing Date</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('script')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });


    </script>
@endsection
