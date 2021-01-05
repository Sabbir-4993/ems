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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Work Detail</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12" id="accordion">
                                    <div class="card card-primary card-outline">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    1. Lorem ipsum dolor sit amet
                                                </h4>
                                            </div>
                                        </a>
                                        <div id="collapseOne" class="collapse hide" data-parent="#accordion">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                            </div>
                                        </div>
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
                                    <b class="d-block">{{$detailswork->assign_employee}}</b>
                                </p>
                                <p class="text-sm">Remaining Day
                                @php
                                    $diff = Carbon\Carbon::parse($detailswork->subWork_end)->diffInDays(Carbon\Carbon::now())
                                @endphp
                                    @if($diff <= 0)
                                        <b class="d-block"><span class="badge badge-danger">Over Date</span></b>
                                @else
                                <b class="d-block">{{$diff}}</b>
                                @endif
                                </p>
                            </div>

                            <div class="text-center mt-5 mb-3">
                                <a class="btn btn-info btn-lg "  href="#" data-toggle="modal"  data-target="#modal-m" >
                                    <i class="fas fa-toolbox"></i>
                                    Refer No
                                </a>
                                <a class="btn btn-info btn-lg "  href="#" data-toggle="modal"  data-target="#modal-sm" >
                                    <i class="fas fa-reply"></i>
                                    Remark
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

    </section>
    //add referNO
    <div class="modal fade" id="modal-m">
        <div class="modal-dialog modal-m">
            <form action="#" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Approved Work!!</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
{{--                    <input type="hidden" name="id" value="{{ $row->id }}">--}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInput">Add Work Name: </label>
                            <input class="form-control" name="ref_no" placeholder="Enter Work ref_no"  type="text" required="">
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

@endsection

