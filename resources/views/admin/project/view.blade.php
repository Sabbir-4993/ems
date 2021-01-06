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
    <section class="content">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects Detail</h3>

                    <div class="card-tools">
                        <button type="button"
                                class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Estimated budget</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$projects->est_budget}} BDT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total amount spent</span>
                                            @php
                                            $ammount = \Illuminate\Support\Facades\DB::table('billing_histories')->where('project_id',$projects->id)->sum('billing_amount');
                                                @endphp
                                            <span class="info-box-number text-center text-muted mb-0">{{$ammount}} BDT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Estimated project duration</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$projects->pro_duration}} Months</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-primary text-left float-right" href="#" data-toggle="modal" data-target="#modal-m{{$projects->id}}">
                                    <i class="fas fa-toolbox"></i> Add Sub Work
                                    </a><br>
                                    <h4 class="text-center">Work Details</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Work Name</th>
                                                    <th>Assign By</th>
                                                    <th> Start Date</th>
                                                    <th> Day Left</th>
                                                    <th> Ref. NO.</th>
                                                    <th> Remark</th>
                                                    <th> Action</th>
                                                </tr>
                                                </thead>
                                                @php
                                                    $upwork = \App\Model\SubWork::where('project_id',$projects->id)->get();
                                                    @endphp
                                                <tbody>
                                                @foreach($upwork as $key=>$row)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$row->subWork_name}}</td>
                                                        <td>
                                                            @php
                                                                $user_id = explode(',', $row->assign_employee);
                                                                $users =\App\User::whereIn('id', $user_id)->get();
                                                            @endphp
                                                            @foreach($users as $user)
                                                                <b class="d-block">{{$user->name}}</b>
                                                            @endforeach
                                                        </td>
                                                        <td>{{$row->subWork_start}}</td>
                                                        @php
                                                            $diff = Carbon\Carbon::parse($row->subWork_end)->diffInDays(Carbon\Carbon::now())
                                                        @endphp
                                                        <td>
                                                            @if($diff <= 0)
                                                                <span class="badge badge-danger">Over Date</span>
                                                            @else
                                                                {{$diff}}
                                                            @endif
                                                        </td>
                                                        <td>{{$row->ref_no}}</td>
                                                        <td>{{$row->remarks}}</td>
                                                        <td class="project-actions text-left">
                                                            <a class="btn btn-primary btn-m"
                                                               href="{{route('subWork.details',[$row->id])}}">
                                                                <i class="fas fa-folder"></i>
                                                                View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-success"><i class="fas fa-project-diagram"></i> {{$projects->project_name}}
                            </h3>
                            <p class="text-muted">{{$projects->description}}</p>
                            <br>
                            <p class="text-sm text-muted">Project Create
                                <b class="d-block">{{$projects->created_at->diffForHumans()}}</b>
                            </p>
                            <div class="text-muted">
                                <p class="text-sm">Project Status
                                    @if($projects->status=='0')
                                        <b class="d-block">
                                            <span class="badge badge-primary">Running</span>
                                        </b>
                                    @elseif($projects->status=='1')
                                        <b class="d-block">
                                            <span class="badge badge-warning">Hold</span>
                                        </b>
                                    @elseif($projects->status=='2')
                                        <b class="d-block">
                                            <span class="badge badge-danger">Canceled</span>
                                        </b>
                                    @elseif($projects->status=='3')
                                        <b class="d-block">
                                            <span class="badge badge-success">Complete</span>
                                        </b>
                                    @endif
                                </p>
                                <p class="text-sm">Client Company
                                    <b class="d-block">{{$projects->company_name}}</b>
                                </p>
                                <p class="text-sm">Project Leader
                                    <b class="d-block">{{$projects->project_leader}}</b>
                                </p>
                            </div>

                            <h5 class="mt-5 text-muted">Project files</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                        Functional-requirements.docx</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i>
                                        UAT.pdf</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>
                                        Email-from-flatbal.mln</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i>
                                        Logo.png</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                        Contract-10_12_2014.docx</a>
                                </li>
                            </ul>
                            <div class="text-center mt-5 mb-3">
                                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </section>
{{--    //model part--}}
    <div class="modal fade" id="modal-m{{$projects->id}}">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="modal-dialog modal-m">
            <form action="{{route('subWork.store')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Approved Work!!</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="project_id" value="{{ $projects ->id }}">
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">Add Work Name: </label>
                        <input class="form-control" name="work_name" placeholder="Enter Work Name"  type="text" required="">
                    </div>
                    <div class="form-group">
                            <label for="end_date" class="col-form-label">Work Start</label>
                            <input class="form-control" type="date"  name="work_start">
                    </div>
                        <!-- /.form-group -->
                    <div class="form-group">
                            <label for="end_date" class="col-form-label">Work End</label>
                            <input class="form-control" type="date" name="work_end">
                    </div>
                    <div class="form-group">
                        <label for="">Assign Employee</label>
                        <select class="select2" multiple="multiple" id="chosen-select" name="employee_id[]" data-placeholder="Select a State" style="width: 100%;">
                                @foreach(\App\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                         </select>
                    </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Add Work</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('css')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
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
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
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
