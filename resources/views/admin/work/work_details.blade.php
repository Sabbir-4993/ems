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
                        <li class="breadcrumb-item active">Work Details</li>
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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Particulars of <b>{{$detailswork->subWork_name}}</b> </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="col-12">
                                <a class="btn btn-primary text-left float-right" href="#" data-toggle="modal" data-target="#modal-xl">
                                    <i class="fas fa-toolbox"></i> Add Particular
                                </a><br>
                                <h4 class="text-center"> Particular  Details</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Particular Name</th>
                                                <th>Particular Description</th>
                                                <th>Action </th>
                                            </tr>
                                            @php
                                                $particulars = \Illuminate\Support\Facades\DB::table('sub_work_details')->where('subWork_id',$detailswork->id )->get();
                                                @endphp
                                            </thead>
                                            @foreach($particulars as $key=>$row)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$row->work_name}}</td>
                                                    <td>{{$row->work_details}}</td>
                                                    <td class="project-actions text-left">
{{--                                                        <a class="btn btn-info btn-xs" href="{{route('project.edit',[$row->id])}}">--}}
{{--                                                            <i class="fas fa-pencil-alt"></i>--}}
{{--                                                            Edit--}}
{{--                                                        </a>--}}
                                                        <a class="btn btn-danger btn-xs" href="#" data-toggle="modal"
                                                           data-target="#modal-sm{{$row->id}}">
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="modal-sm{{$row->id}}">
                                                        <div class="modal-dialog modal-sm">
                                                            <form action="{{route('subWork.deleteParticular',[$row->id])}}" method="post">
                                                                @csrf
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
                                                </tr>
                                            @endforeach
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-success"><i class="fas fa-project-diagram"></i>
                                @php
                                    $projectDetails =\App\Project::where('id',$detailswork->project_id)->first();
                                @endphp
                                {{$projectDetails->project_name}}
                            </h3>
                            <br>
                            <div class="text-muted">
                                <h3 class="text-info"><i class="fas fa-toolbox"></i>
                                    {{$detailswork->subWork_name}}
                                </h3>
                                <p class="text-sm">Assign To
                                    @php
                                        $user_id = explode(',', $detailswork->assign_employee);
                                        $users = \App\User::whereIn('id', $user_id)->get();
                                    @endphp
                                    @foreach($users as $user)
                                    <b class="d-block">{{$user->name}}</b>
                                    @endforeach
                                </p>
                                <p class="text-sm">Work Estimated Date <br>Form
                                    <b class="d-block">{{$detailswork->subWork_start}} </b> to  <b class="d-block">{{$detailswork->subWork_end}}</b>
                                </p>
                                <p class="text-sm">Remaining Day
                                @php
                                    $diff = Carbon\Carbon::parse($detailswork->subWork_end);
                                @endphp
                                @if($diff ->isPast())
                                        <b class="d-block"><span class="badge badge-danger">Over Date</span></b>
                                @else
                                <b class="d-block">{{Carbon\Carbon::parse($detailswork->subWork_end)->diffInDays(Carbon\Carbon::now())}}</b>
                                @endif
                                </p>
                            </div>

                            <div class="text-center mt-5 mb-3">
                                <a class="btn btn-info btn-lg "  href="#" data-toggle="modal"  data-target="#modal-m" >
                                    <i class="fas fa-toolbox"></i>
                                    Refer No
                                </a>
                                @if($diff ->isPast())
                                    <a class="btn btn-info btn-lg "  href="#" data-toggle="modal"  data-target="#modal-sm" >
                                        <i class="fas fa-reply"></i>
                                        Remark
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

    </section>
{{--    //add referNO--}}
    <div class="modal fade" id="modal-m">
        <div class="modal-dialog modal-m">
            <form action="{{route('subWork.storeRefNo')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Work Refer No</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{ $detailswork->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInput"> Work Refer No: </label>
                            <input class="form-control" name="ref_no" placeholder="Enter Work ref_no"  type="text" required="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add Work</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
{{--    Remarks --}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-m">
            <form action="{{route('subWork.storeRemark')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Remark for Delay </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{ $detailswork->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInput"> Delay Remark </label>
                            <textarea  type="text" class="form-control" name="remarks" rows="4" placeholder="Project Description" required=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add Remarks</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
{{--    particular--}}
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-m">
            <form action="{{route('subWork.storeParticular')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Remark for Delay </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{ $detailswork->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInput"> Particular Name</label>
                            <input class="form-control" name="particular_name" placeholder="Enter Particular Name "  type="text" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput"> Particular Details </label>
                            <textarea class="form-control" name="particular_details" placeholder="Enter Particular Details "  type="text" required=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add Particular</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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


