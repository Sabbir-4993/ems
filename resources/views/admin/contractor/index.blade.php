
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
                    <li class="breadcrumb-item"><a href="{{url('/contractors/create')}}">Create</a></li>
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
                        <h3 class="card-title">Contractor List</h3>
                        <a class="btn btn-info btn-m float-right"  href="#" data-toggle="modal"  data-target="#modal-sm" >
                            <i class="fas fa-plus"></i>
                            Add Contractor
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th >Sl</th>
                                <th >Name</th>
                                <th >Phone</th>
                                <th >Address </th>
                                <th >Refer BY </th>
                                <th>Details </th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($contractors as $key => $row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$row->contractor_name}}</td>
                                        <td>{{$row->contractor_phone}}</td>
                                        <td>{{$row->contractor_address}}</td>
                                        <td>{{$row->assign_by}}</td>
                                        <td>{{$row->contractor_details}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal"
                                               data-target="#modal-sm{{$row->id}}">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <div class="modal fade" id="modal-sm{{$row->id}}">
                                                <div class="modal-dialog modal-m">
                                                    <form action="{{route('contractors.update',[$row->id])}}" method="post">
                                                        @csrf
                                                        {{method_field('PATCH')}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="card-title">Add Material Category</h3>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="exampleInputDepartmentName">Name</label>
                                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="" value="{{$row->contractor_name}}">
                                                                @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                                <br>
                                                                <label for="exampleInputDepartmentName"> Number</label>
                                                                <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" placeholder="" value="{{$row->contractor_phone}}">
                                                                @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                 </span>
                                                                @enderror
                                                                <br>
                                                                <label for="exampleInputDepartmentName"> Address</label>
                                                                <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" placeholder="" value="{{$row->contractor_address}}"
                                                                @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                 </span>
                                                                @enderror
                                                                <br>
                                                                <label for="exampleInputDepartmentName"> Refer by</label>
                                                                <input class="form-control @error('referBy') is-invalid @enderror" name="referBy" type="text" placeholder="" value="{{$row->assign_by}}">
                                                                @error('referBy')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                             </span>
                                                                @enderror
                                                                <br>
                                                                <label for="exampleInputDepartmentName"> Details</label>
                                                                <input class="form-control @error('details') is-invalid @enderror" name="details" type="text" placeholder="" value="{{$row->contractor_details }}">
                                                                @error('details')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                 </span>
                                                                @enderror

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-info">Add Category</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$row->id}}">
                                                <i class="fas fa-trash"></i>
                                                Delete</button>
                                            <!-- /.modal -->
                                            <div class="modal fade" id="modal-sm{{$row->id}}">
                                                <div class="modal-dialog modal-sm">
                                                    <form action="{{route('contractors.destroy',[$row->id])}}" method="post">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete Confirm!!</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Do you Want to Delete ?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal End -->
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
<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-m">
        <form action="{{route('contractors.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="card-title">Add Material Category</h3>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="exampleInputDepartmentName">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="exampleInputDepartmentName"> Number</label>
                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" placeholder="">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                    @enderror
                    <br>
                    <label for="exampleInputDepartmentName"> Address</label>
                    <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" placeholder="">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                    @enderror
                    <br>
                    <label for="exampleInputDepartmentName"> Refer by</label>
                    <input class="form-control @error('referBy') is-invalid @enderror" name="referBy" type="text" placeholder="">
                    @error('referBy')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                    @enderror
                    <br>
                    <label for="exampleInputDepartmentName"> Details</label>
                    <input class="form-control @error('details') is-invalid @enderror" name="details" type="text" placeholder="">
                    @error('details')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                    @enderror

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Add Category</button>
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


