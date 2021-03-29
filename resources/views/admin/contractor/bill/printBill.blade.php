@extends('admin.layouts.master')

@section('content')
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
                        <li class="breadcrumb-item"><a href="{{url('vendor/vendor/report/bill')}}"> Contractor Bill</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3" id="invoice">
                        <!-- title row -->
                        <div class="row ">
                            <div class="col-12">
                                {{--                                <h4>--}}
                                {{--                                    TRIMATRIC | Architects & Engineers--}}
                                {{--                                    <small class="float-right">Date: {{\Carbon\Carbon::today()->format('d/m/y')}}</small>--}}
                                {{--                                </h4>--}}
                                <div class="d-flex justify-content-center">
                                    <address>
                                        <strong><h1>TRIMATRIC Architects & Engineers</h1></strong>
                                        <h6 style="text-align:center;">125 Mezonet Building,Ramna Century Avenue, Boro Moghbazar,Dhaka 1217<br></h6>
                                        <h6 style="text-align:center;">PHONE :+88 02 48321385 || Email: INFO@TRIMATRIC.COM<br></h6>

                                    </address>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <b>Paid To: {{$contractor->contractor_name}}</b><br>

                                    Project Name: <strong>{{$project->project_name}}</strong><br>
                                    Phone: {{$project->phone}}<br>
                                    Email: {{$project->company_email}}
                                </address>
                            </div>

                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Work Order NO: <b>{{$workOrder->work_order}}</b><br>
                                PI/PO Number: <b>{{$printDetails->work_order}}</b><br>
                                Billing Number: <b>{{$printDetails->billing_no}}</b><br>
                                <br>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Billing Date: {{$printDetails->billing_date}}</b>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Billing Date</th>
                                        <th>Description</th>
                                        <th>Billing Method</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$printDetails->billing_date}}</td>
                                        <td>{{$printDetails->billing_details}}</td>
                                        <td>{{$printDetails->billing_method}}</td>
                                        <td>{{$printDetails->billing_amount}}</td>
                                        <td>{{$printDetails->billing_amount}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <h5>In Word:</h5>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total :</th>
                                            <td><strong>{{$printDetails->billing_amount}} ৳</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div><br><br><br><br><br>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col" style="text-align: center; text-decoration: overline;">Prepared BY</div>
                            <div class="col" style="text-align: center; text-decoration: overline;">Checked BY</div>
                            <div class="col" style="text-align: center; text-decoration: overline;">Approved BY</div>
                            <div class="col" style="text-align: center; text-decoration: overline;">Accountant</div>
                            <div class="col" style="text-align: center; text-decoration: overline;">Received BY</div>
                        </div>
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button id="printInvoice" onclick="PrintDiv()" class="btn btn-info"><i class="fa fa-print"></i>Print</button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
@endsection

@section('script')
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>

    <script type="text/javascript">
        function PrintDiv() {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            originalContents.close();

        }
    </script>
@endsection




