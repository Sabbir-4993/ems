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
                        <li class="breadcrumb-item"><a href="{{url('/material/create')}}">Create</a></li>
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

        @if(session('errors'))
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        @if(session('success'))

            @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <div class="container-fluid">
            <form action="{{route('material.upload')}}" enctype="multipart/form-data" method="post">
            @csrf
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Material <small>File Upload</small></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">File Upload</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="material_file" type="file" class="custom-file-input" id="exampleInputFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary float-right">
                                    Submit
                                </button>
                                <br><br>
                                Download <a href="{{asset('uploads/sample/sample.xlsx')}}" download=""><span class="badge-success">Sample File</span></a> for Details
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Material List</h3>
                <a class="btn btn-info btn-m float-right"  href="#" data-toggle="modal"  data-target="#modal-sm" >
                    <i class="fas fa-plus"></i>
                    Add Material
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <td>SN</td>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Unit</td>
                        <td>Price</td>
                        <td>Details</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($material as $key => $row)
                        @php
                            $category = \App\MaterialCategory::where('id', $row->category)->first();
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->material_name}}</td>
                            <td>
                             {{$category->name}}
                            </td>
                            <td>{{$row->unit}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->details}}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="#" data-toggle="modal"
                                   data-target="#modal-sm{{$row->id}}">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <div class="modal fade" id="modal-sm{{$row->id}}">
                                    <div class="modal-dialog modal-m">
                                        <form action="{{route('material.update', [$row->id])}}" method="post">
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
                                                    <label for="exampleInputDepartmentName">Material Name</label>
                                                    <input class="form-control @error('material_name') is-invalid @enderror" name="material_name"
                                                           type="text" placeholder="Material Name" value="{{$row->material_name}}">
                                                    @error('material_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <br>

                                                    <label for="exampleInputDepartmentName">Select Category</label>
                                                    <select id="inputStatus" class="form-control custom-select" name="category">
                                                        @foreach(\App\MaterialCategory::all() as $materialcategory)
                                                            <option value="{{$materialcategory->id}}" {{(($materialcategory->id==$row->category)? 'selected' : '')}}>{{$materialcategory->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>

                                                    <label for="exampleDepartmentDetails">Material Unit</label>
                                                    <input class="form-control @error('unit') is-invalid @enderror" name="unit" type="text"
                                                           placeholder="Material unit" value="{{$row->unit}}">
                                                    @error('unit')
                                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                                    @enderror
                                                    <br>

                                                    <label for="exampleDepartmentDetails">Material Price</label>
                                                    <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                                                           placeholder="Material Price" value="{{$row->price}}">
                                                    @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <br>

                                                    <label for="exampleDepartmentDetails">Material Details</label>
                                                    <textarea name="details" class="form-control @error('details') is-invalid @enderror" cols="30"
                                                              rows="5" id="">{{$row->details}}</textarea>
                                                    @error('details')
                                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                                    @enderror

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Update Material</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
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
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-m">
            <form action="{{route('material.store')}}" method="post">
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
                        <label for="exampleInputDepartmentName">Material Name</label>
                        <input class="form-control @error('material_name') is-invalid @enderror" name="material_name"
                               type="text" placeholder="Material Name">
                        @error('material_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                        <br>

                        <label for="exampleInputDepartmentName">Select Category</label>
                        <select id="inputStatus" class="form-control custom-select" name="category">
                            <option value="" selected disabled>Select Material Category</option>
                            @foreach(\App\MaterialCategory::all() as $materialcategory)
                                <option value="{{$materialcategory->id}}">{{$materialcategory->name}}</option>
                            @endforeach
                        </select>
                        <br>

                        <label for="exampleDepartmentDetails">Material Unit</label>
                        <input class="form-control @error('unit') is-invalid @enderror" name="unit" type="text"
                               placeholder="Material unit">
                        @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>

                        <label for="exampleDepartmentDetails">Material Price</label>
                        <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                               placeholder="Material Price">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>

                        <label for="exampleDepartmentDetails">Material Details</label>
                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" cols="30"
                                  rows="5" id=""></textarea>
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
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropzone/min/dropzone.min.css') }}">
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
    <!-- bs-custom-file-input -->
    <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
