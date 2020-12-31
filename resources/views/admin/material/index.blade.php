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

{{--        @if(isset($errors) && $errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    {{ $error }}--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
        <div class="container-fluid">
            <form action="#" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Material <small>File Upload </small></h3>
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
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->material_name}}</td>
                            <td>{{$row->category}}</td>
                            <td>{{$row->unit}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->details}}</td>
                            <td>
                                <a class="btn btn-block bg-gradient-secondary btn-xs" href="#">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>SN</td>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Unit</td>
                        <td>Price</td>
                        <td>Details</td>
                        <td>Action</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
    <!-- dropzonejs -->
{{--    <script src="{{ asset('backend/plugins/dropzone/min/dropzone.min.js') }}"></script>--}}
{{--    <script>--}}
{{--        // DropzoneJS Demo Code Start--}}
{{--        Dropzone.autoDiscover = false;--}}

{{--        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument--}}
{{--        var previewNode = document.querySelector("#template");--}}
{{--        previewNode.id = "";--}}
{{--        var previewTemplate = previewNode.parentNode.innerHTML;--}}
{{--        previewNode.parentNode.removeChild(previewNode);--}}

{{--        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone--}}
{{--            url: "/target-url", // Set the url--}}
{{--            thumbnailWidth: 80,--}}
{{--            thumbnailHeight: 80,--}}
{{--            parallelUploads: 20,--}}
{{--            previewTemplate: previewTemplate,--}}
{{--            autoQueue: false, // Make sure the files aren't queued until manually added--}}
{{--            previewsContainer: "#previews", // Define the container to display the previews--}}
{{--            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.--}}
{{--        });--}}

{{--        myDropzone.on("addedfile", function(file) {--}}
{{--            // Hookup the start button--}}
{{--            file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };--}}
{{--        });--}}

{{--        // Update the total progress bar--}}
{{--        myDropzone.on("totaluploadprogress", function(progress) {--}}
{{--            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";--}}
{{--        });--}}

{{--        myDropzone.on("sending", function(file) {--}}
{{--            // Show the total progress bar when upload starts--}}
{{--            document.querySelector("#total-progress").style.opacity = "1";--}}
{{--            // And disable the start button--}}
{{--            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");--}}
{{--        });--}}

{{--        // Hide the total progress bar when nothing's uploading anymore--}}
{{--        myDropzone.on("queuecomplete", function(progress) {--}}
{{--            document.querySelector("#total-progress").style.opacity = "0";--}}
{{--        });--}}

{{--        // Setup the buttons for all transfers--}}
{{--        // The "add files" button doesn't need to be setup because the config--}}
{{--        // `clickable` has already been specified.--}}
{{--        document.querySelector("#actions .start").onclick = function() {--}}
{{--            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));--}}
{{--        };--}}
{{--        document.querySelector("#actions .cancel").onclick = function() {--}}
{{--            myDropzone.removeAllFiles(true);--}}
{{--        };--}}
{{--        // DropzoneJS Demo Code End--}}
{{--    </script>--}}

    <!-- bs-custom-file-input -->
    <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
