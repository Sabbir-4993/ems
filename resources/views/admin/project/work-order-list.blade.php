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
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content container">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Work Order List Project Based</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Project Name</th>
                                    <th>Work Order Number</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                      $workOrder = \Illuminate\Support\Facades\DB::table('work_orders')->get();
                                    @endphp
                                    @foreach($workOrder as $key=>$row)
                                    <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                @php
                                                $project = \App\Project::where('id',$row->project_id)->first();
                                                    @endphp
                                                {{$project->project_name}}</td>
                                            <td>{{$row->work_order}}</td>
                                            <td>
                                                @if($row->status=='0')
                                                    <span class="badge badge-primary">Running</span>
                                                @elseif($row->status=='1')
                                                    <span class="badge badge-warning">Hold</span>
                                                @elseif($row->status=='2')
                                                    <span class="badge badge-danger">Canceled</span>
                                                @elseif($row->status=='3')
                                                    <span class="badge badge-success">Complete</span>
                                                @endif
                                             </td>
                                            <td>{{$row->details}}</td>
                                            <td>{{$row->created_date}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-xs" href="#" data-toggle="modal"
                                                   data-target="#modal-m{{$row->id}}">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                                <div class="modal fade" id="modal-m{{$row->id}}">
                                                    <div class="modal-dialog modal-m">
                                                        <form action="{{route('workOrder.update',[$row->id])}}" method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Work Order!!</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input class="form-control" name="project_name"   value="{{$row->project_id}}" type="hidden" required="" >
                                                                    <input class="form-control" name=""   value="{{$project->project_name}}" type="text" required="" disabled>
                                                                    <div class="form-group">
                                                                        <label for="example">Work Order Number</label>
                                                                        <input class="form-control" name="work_order" type="text" value="{{$row->work_order}}" required="">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="inputStatus">Status</label>
                                                                        <select id="inputStatus" class="form-control custom-select" name="status"
                                                                                required="">
                                                                            @if($row->status=='0')
                                                                                <option  disabled>Select one</option>
                                                                                <option value="0" selected>On Running</option>
                                                                                <option value="1">On Hold</option>
                                                                                <option value="2">Canceled</option>
                                                                                <option value="3">Complete</option>
                                                                            @elseif($row->status=='1')
                                                                                <option  disabled>Select one</option>
                                                                                <option value="0">On Running</option>
                                                                                <option value="1" selected>On Hold</option>
                                                                                <option value="2">Canceled</option>
                                                                                <option value="3">Complete</option>
                                                                            @elseif($row->status=='2')
                                                                                <option  disabled>Select one</option>
                                                                                <option value="0">On Running</option>
                                                                                <option value="1">On Hold</option>
                                                                                <option value="2" selected>Canceled</option>
                                                                                <option value="3">Complete</option>
                                                                            @elseif($row->status=='3')
                                                                                <option disabled>Select one</option>
                                                                                <option value="0">On Running</option>
                                                                                <option value="1">On Hold</option>
                                                                                <option value="2">Canceled</option>
                                                                                <option value="3" selected>Complete</option>
                                                                            @endif

                                                                        </select>
                                                                    </div>
                                                                    <input class="form-control"  name="updated_by" type="hidden" value="{{Auth()->user()->id}}">
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Update Work Order</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
{{--                                                    <!-- /.modal-dialog -->--}}
                                                </div>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
    <link rel="stylesheet"
          href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
