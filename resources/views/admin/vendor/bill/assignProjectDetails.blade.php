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
                        <li class="breadcrumb-item"><a href="{{route('vendorAssignProject.view')}}">Assign Project</a></li>
                        <li class="breadcrumb-item active">View Assign Project History</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        @if(Session::has('message1'))
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> {{Session::get('message1')}}</h5>
            </div>
        @endif
        @if(Session::has('message2'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> {{Session::get('message2')}}</h5>
            </div>
        @endif
        <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects Detail</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @foreach($projects as $project)
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Bill</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$project->total_payable}} BDT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Pay Amount</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$project->total_pay}} BDT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Due Amount</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$project->total_due}} BDT</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Billing History</h4>
                                    <div class="post">
                                        @php
                                        $vendorBillHistory = \Illuminate\Support\Facades\DB::table('vendor_billing_histories')
                                                        ->where('pi_number',$project->pi_number)
                                                        ->get();
                                        @endphp
                                        <div class="user-block">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>PI No</th>
                                                    <th>BILLING No</th>
                                                    <th>Billing Amount</th>
                                                    <th>Billing Method</th>
                                                    <th>Billing Details</th>
                                                    <th>Billing Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($vendorBillHistory as $key=>$row)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$row->billing_no}}</td>
                                                    <td>{{$row->pi_number}}</td>
                                                    <td>{{$row->billing_amount}}</td>
                                                    <td>{{$row->billing_method}}</td>
                                                    <td>{{$row->billing_details}}</td>
                                                    <td>{{$row->billing_date}}</td>
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
                            @php
                                $projectDetails = \App\Project::where('id',$project->project_id)->first();
                                $vendorDetails = \App\Vendor::where('id',$project->vendor_id)->first();
                            @endphp
                            <h3 class="text-success"><i class="fas fa-project-diagram"></i>
                                {{$projectDetails->project_name}}
                            </h3>
                            <br>
                            <div class="text-muted">
                                <p class="text-sm">Project Status
                                    @if($projectDetails->status=='0')
                                        <b class="d-block">
                                            <span class="badge badge-primary">Running</span>
                                        </b>
                                    @elseif($projectDetails->status=='1')
                                        <b class="d-block">
                                            <span class="badge badge-warning">Hold</span>
                                        </b>
                                    @elseif($projectDetails->status=='2')
                                        <b class="d-block">
                                            <span class="badge badge-danger">Canceled</span>
                                        </b>
                                    @elseif($projectDetails->status=='3')
                                        <b class="d-block">
                                            <span class="badge badge-success">Complete</span>
                                        </b>
                                    @endif
                                </p>
                                <p class="text-sm">Client Company
                                    <b class="d-block">{{$projectDetails->company_name}}</b>
                                </p>
                                <p class="text-sm">Project Leader
                                    <b class="d-block">{{$projectDetails->project_leader}}</b>
                                </p>
                                <p class="text-sm"> PI number
                                    <b class="d-block">{{$project->pi_number}}</b>
                                </p>
                            </div>
                            <div class="text-muted">
                            <p class="text-sm">Contractor Name
                                <b class="d-block text-gray" style="font-size: 16px;">
                                    <i class="fas fa-user"></i>
                                    {{$vendorDetails->vendor_name}}
                                </b>
                            </p>
                            <p class="text-sm">Contractor Number
                                <a href="tel: {{$vendorDetails->vendor_phone}}" style="font-size: 16px;" class="d-block text-info">
                                    <i class="fas fa-phone"></i>
                                    {{$vendorDetails->vendor_phone}}
                                </a>
                            </p>
                            </div>
                            <div class="text-center mt-5 mb-3">
                                @if($project ->total_due == 0 && $project ->total_payable == $project ->total_pay)
                                    <a class="btn btn-danger btn-lg disabled"  href="#" data-toggle="modal"
                                       data-target="#modal-sm{{$project->id}}">
                                        <i class="fas fa-money-bill"></i>
                                        Bill Paid
                                    </a>
                                @else
                                    <a class="btn btn-primary btn-lg" href="#" data-toggle="modal"
                                       data-target="#modal-sm{{$project->id}}">
                                        <i class="fas fa-money-bill"></i>
                                        Pay Bill
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
        <div class="modal fade" id="modal-sm{{$project->id}}">
            <div class="modal-dialog modal-sm">
                <form action="{{route('vendorAssignProject.payBill')}}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Bill Payment!!</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="pi_number" value="{{ $project ->pi_number }}">
                        <input type="hidden" name="project_work_no" value="{{ $project ->project_work_order }}">
                        <input type="hidden" name="vendor_id" value="{{ $vendorDetails->id}}">
                        <input type="hidden" name="project_id" value="{{ $project ->project_id }}">
                        <div class="modal-body">
                            <label for="exampleInput">Bill No</label>
                            <input class="form-control @error('billing_no') is-invalid @enderror" name="billing_no" type="text" placeholder="Enter Bill NO" required="">
                            @error('billing_no')
                            <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                            @enderror

                            <br>

                            <label for="exampleInput">Pay Amount </label>
                            <input class="form-control" name="pay_amount" type="text" required="">

                            <br>

                            <label for="exampleInput">Pay By</label>
                            <select id="billing_method" class="form-control custom-select" name="billing_method" required="">
                                <option selected disabled>Select one</option>
                                <option value="Cash">Cash</option>
                                <option value="Bkash">Bkash</option>
                                <option value="Nagad">Nagad</option>
                                <option value="Rocket">Rocket</option>
                                <option value="Check">Check</option>
                            </select>

                            <br>

                            <label for="exampleInput">Details</label>
                            <input class="form-control" name="billing_details" placeholder="Enter mobile banking/check number" type="text" required="">

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Pay Bill</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

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
