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
                        <li class="breadcrumb-item"><a href="{{url('contractor/contractor/report/bill')}}"> Contractor Bill</a></li>
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
                                <strong class="float-right">Date: {{\Carbon\Carbon::today()->format('d/m/y')}}</strong>
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

                            </div>
                            <div class="col-sm-4 invoice-col">
                                Work Order NO: <b>{{$workOrder->work_order}}</b><br>
                                PI/PO Number: <b>{{$printDetails->work_order}}</b><br>
                                <br>
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
                                        <th>Billing NO</th>
                                        <th>Billing Method</th>
                                        <th>Billing details</th>
                                        <th style="text-align:center">Bill Payment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($billingDetails as $billingDetails)
                                    <tr>
                                        <td>{{$billingDetails->billing_date}}</td>
                                        <td>{{$billingDetails->billing_no}}</td>
                                        <td>{{$billingDetails->billing_method}}</td>
                                        <td>{{$billingDetails->billing_details}}</td>
                                        <td style="text-align:center">{{$billingDetails->billing_amount}}</td>
                                    </tr>
                                        @endforeach
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
                                            <th style="text-align:right">Total Pay</th>
                                            <td style="width:35%;text-align:center">= {{ $printDetails->total_pay}} <b>৳</b></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align:right">Total Bill</th>
                                            <td style="text-align:center">= {{ $printDetails->total_payable}} <b>৳</b></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align:right">Total Due(-)</th>
                                            <td style="text-align:center">= {{ $printDetails->total_due }} <b>৳</b></td>
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
                        </div><br><br>
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button id="printInvoice" onclick="PrintDiv()" class="btn btn-info"><i class="fa fa-print"></i>Print</button>
{{--                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
{{--                                    <i class="fas fa-download"></i> Generate PDF--}}
{{--                                </button>--}}
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




