
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
                        <li class="breadcrumb-item"><a href="{{route('assignProject.index')}}">Assign</a></li>
                        <li class="breadcrumb-item active">Project List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(Session::has('message'))
            <div class="alert alert-danger alert-dismissible">
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
                                    <th>Contractor Name</th>
                                    <th>Project Name</th>
                                    <th>Contractor Category</th>
                                    <th>Work Order</th>
                                    <th>Total Payable</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignProjectDetails as $key=>$row)
                                    @php
                                        $projects = \App\Project::where('id',$row->project_id)->get();
                                        $contractors = \App\Contractor::where('id',$row->contractor_id)->get();
                                        $categories = \App\Category::where('id',$row->category_id)->get();
                                    @endphp
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            @foreach($contractors as $contractor)
                                                {{ $contractor ->contractor_name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($projects as $project)
                                                {{ $project ->project_name }}
                                            @endforeach
                                        </td>
                                        <td>
                                             @foreach($categories as $category)
                                                {{ $category ->cat_name }}
                                            @endforeach
                                        </td>
                                        <td>{{$row ->work_order  }}</td>
                                        <td>{{ $row ->total_payable }}</td>
                                        <td class="project-actions text-center">
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route('assignProject.details',[$row->id])}}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>
                                            @if($row ->total_due == 0 && $row ->total_payable == $row ->total_pay)
                                            <a class="btn btn-info btn-sm disabled"  href="#" data-toggle="modal"
                                               data-target="#modal-sm{{$row->id}}">
                                                <i class="fas fa-money-bill"></i>
                                                Pay Bill
                                            </a>
                                            @else
                                                <a class="btn btn-info btn-sm" href="#" data-toggle="modal"
                                                   data-target="#modal-sm{{$row->id}}">
                                                    <i class="fas fa-money-bill"></i>
                                                    Pay Bill
                                                </a>
                                            @endif
                                        </td>
                                        <div class="modal fade" id="modal-sm{{$row->id}}">
                                            <div class="modal-dialog modal-sm">
                                                <form action="{{route('assignProject.payBill')}}" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Bill Payment!!</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <input type="hidden" name="work_id" value="{{ $row ->work_order }}">
                                                        <input type="hidden" name="project_id" value="{{ $row ->project_id }}">
                                                        <div class="modal-body">
                                                            <label for="exampleInputDepartmentName"> Bill NO </label>
                                                            <input class="form-control @error('billing_no') is-invalid @enderror" name="billing_no" type="text" placeholder="Enter Bill NO">
                                                            @error('billing_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                             </span>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-body">
                                                            <lable>Pay Amount </lable>
                                                            <input class="form-control" name="pay_amount" type="text">
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="billing_method">Pay By</label>
                                                            <select id="billing_method" class="form-control custom-select" name="billing_method" required="">
                                                                <option selected disabled>Select one</option>
                                                                <option value="Check">ON Check</option>
                                                                <option value="Bkash">BY Bkash</option>
                                                                <option value="Cash">BY Cash</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Pay Bill</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Contractor Name</th>
                                    <th>Project Name</th>
                                    <th>Contractor Category</th>
                                    <th>Work Order</th>
                                    <th>Total Payable</th>
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

