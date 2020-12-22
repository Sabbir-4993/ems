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
                        <li class="breadcrumb-item"><a href="{{url('/project/create')}}">Create</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Project List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Project Name</th>
                                    <th>Company Name</th>
                                    <th>Description</th>
                                    <th>Ref.</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Project Lead</th>
                                    <th>Status</th>
                                    <th>Budget</th>
                                    <th>Duration</th>
                                    <th>Start</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $key=>$row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$row->project_name}}</td>
                                        <td>{{$row->company_name}}</td>
                                        <td>{{$row->description}}</td>
                                        <td>{{$row->project_ref}}</td>
                                        <td>{{$row->company_email}}</td>
                                        <td>{{$row->address}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{$row->project_leader}}</td>
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
                                        <td>{{$row->est_budget}}</td>
                                        <td>{{$row->pro_duration}}</td>
                                        <td>{{$row->project_start}}</td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-xs"
                                               href="{{route('project.show',[$row->id])}}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-xs" href="{{route('project.edit',[$row->id])}}">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-xs" href="#" data-toggle="modal"
                                               data-target="#modal-sm{{$row->id}}">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </td>
                                        <!-- /.modal -->
                                        <div class="modal fade" id="modal-sm{{$row->id}}">
                                            <div class="modal-dialog modal-sm">
                                                <form action="{{route('project.destroy',[$row->id])}}" method="post">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Confirm!!</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Do you Want to Delete ?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal End -->
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Project Name</th>
                                    <th>Company Name</th>
                                    <th>Description</th>
                                    <th>Ref.</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Project Lead</th>
                                    <th>Status</th>
                                    <th>Budget</th>
                                    <th>Duration</th>
                                    <th>Start</th>
                                    <th>Action</th>
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
    </div>
    <!-- /.content-wrapper -->
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

