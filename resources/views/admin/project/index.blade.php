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
                            <h3 class="card-title">Project List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 1%">SN</th>
                                    <th style="width: 8%">Project Name</th>
                                    <th style="width: 10%">Company Name</th>
                                    <th style="width: 10%">Email</th>
                                    <th style="width: 10%">Address</th>
                                    <th style="width: 10%">Contact</th>
                                    <th style="width: 8%">Project Lead</th>
                                    <th style="width: 5%">Status</th>
                                    <th style="width: 5%">Budget</th>
                                    <th style="width: 3%">Duration</th>
                                    <th style="width: 8%">Start</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $key=>$row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$row->project_name}}</td>
                                        <td>{{$row->company_name}}</td>
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
                                        <td class="project-actions text-left">
                                            <a class="btn btn-primary btn-xs" href="#" data-toggle="modal"
                                               data-target="#modal-m{{$row->id}}">
                                                <i class="fas fa-money-bill"></i>
                                                Add WO.
                                            </a>
                                            <div class="modal fade" id="modal-m{{$row->id}}">
                                                <div class="modal-dialog modal-m">
                                                    <form action="{{route('workOrder.orderStore')}}" method="post">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Add Work Order!!</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                           <div class="modal-body">
                                                               <input class="form-control" name="project_name"   value="{{$row->id}}" type="hidden" required="">
                                                               <div class="form-group">
                                                                   <label for="example">Work Order Number</label>
                                                                   <input class="form-control @error('work_order') is-invalid @enderror" name="work_order" type="text" placeholder="" required="">
                                                                   @error('work_order')
                                                                   <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                   @enderror
                                                               </div>
                                                               <div class="form-group">
                                                                   <label for="inputStatus">WO. Status</label>
                                                                   <select id="inputStatus" class="form-control custom-select" name="status"
                                                                           required>
                                                                       <option selected disabled>Select Status</option>
                                                                       <option value="0">On Running</option>
                                                                       <option value="1">On Hold</option>
                                                                       <option value="2">Canceled</option>
                                                                       <option value="3">Complete</option>
                                                                   </select>
                                                               </div>
                                                               <div class="form-group">
                                                                   <label for="inputStatus">Details</label>
                                                                   <textarea name="details" id="details" cols="10" class="form-control" rows="5" required=""></textarea>
                                                               </div>
                                                               <input class="form-control"  name="created_by" type="hidden" value="{{Auth()->user()->id}}">
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Add Work Order</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                    <!-- /.modal-content -->
                                                <!-- /.modal-dialog -->
                                            </div>
{{--                                            <a class="btn btn-secondary btn-xs"--}}
{{--                                               href="{{route('workOrder.addWorkOrder')}}">--}}
{{--                                                <i class="fas fa-plus"></i>--}}
{{--                                                Add WO.--}}
{{--                                            </a>--}}
                                            <a class="btn btn-primary btn-xs"
                                               href="{{route('project.show',[$row->id])}}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-xs" href="{{route('project.edit',[$row->id])}}">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
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
        </div>            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
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

