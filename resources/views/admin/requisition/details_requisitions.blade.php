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
                        {{--                        <li class="breadcrumb-item"><a href="{{route('requistion.store')}}">Requisition</a></li>--}}
                        <li class="breadcrumb-item active">Requisition </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if(Session::has('message'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
        </div>
    @endif
    <!-- /.content-header -->
    <!-- page title area end -->

    <form action="{{route('requisition.approve')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects Detail</h3>

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
                                <div class="col-12">
                                    <h4>Requisition Details </h4>
                                    <div class="post">
                                        <div class="user-block table-responsive">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Product Name</th>
                                                    <th>Product quantity</th>
                                                    <th> Unit</th>
                                                    <th> Remarks </th>
                                                    <th>Price/Unit</th>
                                                    <th>Total</th>
                                                    <th>Notes </th>
{{--                                                    <th>Action </th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($detailsRequisitions as $key=>$row)
                                                    <tr>
                                                    <td>{{$key+1}}</td>
                                                        <td>
                                                           <input type="text"  name="particular[]" value="{{$row->particular}}" class="form-control" readonly >
                                                        </td>
                                                         <td>
                                                            <input class="form-control " type="text" id="qty{{$key}}" name="quantity[]" value="{{$row->quantity}}" readonly >
                                                        </td>
                                                        <td>
                                                            <input type="text" id="unit" name="unit[]" value="{{$row->unit}}"  class="form-control" readonly >
                                                        </td>
                                                        <td>
                                                            <input type="text" id="" name="remarks[]" value="{{$row->remarks}}" class="form-control " readonly>
                                                        </td>
                                                        <td>
                                                        <input class="form-control " type="text" id="price{{$key}}"   name="price[]"  onchange="AutoCalc()" >
                                                        </td>
                                                        <td>
                                                        <input class="form-control " type="text" id="total{{$key}}"   name="total[]" >
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="pro_remarks[]">
                                                        </td>
{{--                                                        <td>--}}
{{--                                                        </td>--}}
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <th colspan="5"></th>
                                                <th>Total =</th>
                                                <th>
                                                    <output id="subtotal"></output>
                                                </th>
                                                <th> </th>
{{--                                                <th> </th>--}}
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-success"><i class="fas fa-project-diagram"></i>
                                @php
                                $projectDetails =\App\Project::where('id',$row->project_id)->first();
                                @endphp
                                {{$projectDetails->project_name}}
                                <input type="hidden" name="project_id" value="{{$row->project_id}}">
                                <input type="hidden" name="id" value="{{$row->id}}">
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
                            <div class="text-muted">
                                <p class="text-sm">Requisition From :
                                    <b class="d-block text-gray" style="font-size: 16px;">
                                        <i class="fas fa-user"></i>
                                        @php
                                            $users = \App\User::where('id',$row->created_by)->first();
                                        @endphp
                                        {{$users->name}}
                                    </b>
                                </p>
                                <p class="text-sm"> Number
                                    <a href="tel: {{$users->mobile_number}}" style="font-size: 16px;" class="d-block text-info">
                                        <i class="fas fa-phone"></i>
                                        {{$users->mobile_number}}
                                    </a>
                                </p>
                            </div>
                            <div class="text-center mt-5 mb-3">
{{--                                @if($project ->total_due == 0 && $project ->total_payable == $project ->total_pay)--}}
{{--                                    <a class="btn btn-danger btn-lg disabled"  href="#" data-toggle="modal"--}}
{{--                                       data-target="#modal-sm{{$project->id}}">--}}
{{--                                        <i class="fas fa-money-bill"></i>--}}
{{--                                        Bill Paid--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <a class="btn btn-primary btn-lg" href="#" data-toggle="modal"--}}
{{--                                       data-target="#modal-sm{{$project->id}}">--}}
{{--                                        <i class="fas fa-money-bill"></i>--}}
{{--                                        Pay Bill--}}
{{--                                    </a>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </div>
                    <div class="row card-footer">
                        <div class="col-12">
                            <input type="submit" value="Approved" class="btn btn-success float-left">
                        </div>
                    </div>
                </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </form>

@endsection
@section('script')
    <script>
        function AutoCalc() {
            var textBox = new Array();
            textBox = document.getElementsByTagName('input');
            var subtotal = 0;
            for (i = 0; i < textBox.length; i++) {
                var total = document.getElementById('qty'+[i]).value * document.getElementById('price'+[i]).value;
                document.getElementById('total'+[i]).value = total;
                subtotal = subtotal +  parseFloat(document.getElementById('total'+[i]).value);
                document.getElementById('subtotal').value = parseFloat(subtotal);
            }
        }
    </script>
@endsection



