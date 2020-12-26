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
                        <li class="breadcrumb-item active">View Order History</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
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
                                            <span class="info-box-text text-center text-muted">Total Budget</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$project->total_payable}} BDT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Pay Ammount</span>
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
                                        $billhistory = \Illuminate\Support\Facades\DB::table('billing_histories')
                                                        ->where('project_work_no',$project->work_order)
                                                        ->get();
                                        @endphp
                                        <div class="user-block">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Work No</th>
                                                    <th>BILLING No</th>
                                                    <th>Billing Amount</th>
                                                    <th>Billing Method</th>
                                                    <th>Billing Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($billhistory as $key=>$row)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$row->project_work_no}}</td>
                                                    <td>{{$row->billing_no}}</td>
                                                    <td>{{$row->billing_amount}}</td>
                                                    <td>{{$row->billing_method}}</td>
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
                                $contractorDetails = \App\Contractor::where('id',$project->contractor_id)->first();
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
                            </div>

                            <h4 class="text-success">
                                <i class="fas fa-user"></i>
                                {{$contractorDetails->contractor_name}}
                            </h4>
                            <h4 class="text-info">
                                <i class="fas fa-phone"></i>
                                {{$contractorDetails->contractor_phone}}
                            </h4>

                            <div class="text-center mt-5 mb-3">
                                <a href="#" class="btn btn-sm btn-warning">Project Report</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
