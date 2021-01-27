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
                        <li class="breadcrumb-item"><a href="{{url('requisition/complete-requisition')}}">Approved Requisition</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{--    <div class="toolbar hidden-print">--}}
{{--        <div class="text-center">--}}
{{--            <button id="printInvoice" onclick="PrintDiv()" class="btn btn-info"><i class="fa fa-print"></i>Print</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <br>--}}
{{--    <div id="invoice">--}}
{{--        <div class="invoice overflow-auto">--}}
{{--            <div class="container col-md-8">--}}
{{--                @foreach($approvedDetailsRequisitions as $key=>$row)--}}

{{--                <?php--}}
{{--                $projectDetails =\App\Project::where('id',$row->project_id)->first();--}}
{{--                ?>--}}
{{--                @endforeach--}}
{{--                <header>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-8">--}}
{{--                            <h4 class="name" style="color: #0C9A9A">--}}
{{--                                @php--}}
{{--                                    $users = \App\User::where('id',$row->user_id)->first();--}}
{{--                                @endphp--}}
{{--                                REQUISITION FORM:--}}
{{--                            </h4>--}}
{{--                            <div class="col">--}}
{{--                                <div class="row">--}}
{{--                                    <span>REQ NO:</span><span> TAE / Procurement / 2020 _/<strong>{{$row->req_no}}</strong></span>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <span>Ref./Work Order: </span><strong>{{$projectDetails->project_ref}}</strong>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <h6 class="to">Date: <span>{{$row->requisition_date}}</span></h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 company-details">--}}
{{--                            <a target="_blank" href="{{'/'}}">--}}
{{--                                <img src="{{ asset('uploads/company_logo/logo.png') }}') }}"></a>                        </div>--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--                <main>--}}
{{--                    <div class="row contacts">--}}
{{--                        <div class="col invoice-to">--}}
{{--                            <div class="text-gray-light"><u>Requisition Details:</u></div>--}}
{{--                            <div class=" row ">--}}
{{--                                <div class="col">--}}
{{--                                    <p class="to">Project Name: <strong>{{$projectDetails->project_name}} </strong></p>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <p class="to float-right">Date: <span>{{$row->requisition_date}}</span></p>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                            <div class=" row ">--}}
{{--                                <div class="col">--}}
{{--                                    <p class="to"> PCO: <span>{{$users->name}}</span></p>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <p class="float-right">Contact No. <span>{{$users->mobile_number}}</span></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div >--}}
{{--                                <div class="col">--}}
{{--                                    <p class="float-left"> Project Address: <span>{{$projectDetails->address}}</span></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <table>--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>SN</th>--}}
{{--                            <th>Description of Particular</th>--}}
{{--                            <th>Quantity</th>--}}
{{--                            <th>Unit</th>--}}
{{--                            <th>Price / Unit</th>--}}
{{--                            <th>Total Price  </th>--}}
{{--                            <th>  Remarks</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($approvedDetailsRequisitions as $key=>$row)--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">{{$key+1}}</td>--}}
{{--                                <td class="text-center">--}}
{{--                                    {{$row->particular}}--}}
{{--                                </td>--}}
{{--                                <td class="text-center">--}}
{{--                                    {{$row->quantity}}--}}
{{--                                </td>--}}
{{--                                <td class="text-center">--}}
{{--                                    {{$row->unit}}--}}
{{--                                </td>--}}
{{--                                <td class="text-center">--}}
{{--                                    {{$row->unit_price}}--}}
{{--                                </td >--}}
{{--                                <td class="text-center">--}}
{{--                                    {{$row->total_price}}--}}
{{--                                </td >--}}
{{--                                <td >--}}
{{--                                </td>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <div class="empty"></div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col" style="text-align: center; text-decoration: overline;">Prepared BY</div>--}}
{{--                        <div class="col" style="text-align: center; text-decoration: overline;">Received BY</div>--}}
{{--                        <div class="col" style="text-align: center; text-decoration: overline;">Approved BY</div>--}}
{{--                    </div>--}}
{{--                </main>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Content Wrapper. Contains page content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3" id="invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        TRIMATRIC | Architects & Engineers
                                        <small class="float-right">Date: {{\Carbon\Carbon::today()->format('d/m/y')}}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>TRIMATRIC | Architects & Engineers.</strong><br>
                                        125 Mezonet Building,<br>
                                        Ramna Century Avenue, Boro Moghbazar,<br>
                                        Dhaka 1217<br>
                                        PHONE :+88 02 48321385<br>
                                        Email: INFO@TRIMATRIC.COM
                                    </address>
                                </div>
                                @foreach($approvedDetailsRequisitions as $key=>$row)
                                    @php
                                            $projectDetails =\App\Project::where('id',$row->project_id)->first();
                                      @endphp
                                 @endforeach
                            <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{$projectDetails->project_name}}</strong><br>
                                        {{$projectDetails->address}}<br>
                                        Phone: {{$projectDetails->phone}}<br>
                                        Email: {{$projectDetails->company_email}}
                                    </address>
                                </div>

                            <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Requisition NO: <b>{{$row->req_no}}</b><br>
                                    <br>
                                    <b>Requisition by:</b><br>
                                    <b>Name :</b>
                                    @php
                                    $user = \App\User::where('id',$row->created_by)->first();
                                        @endphp
                                    {{$user->name}}
                                    <br>
                                    <b>Phone:</b>  {{$user->mobile_number}}
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
                                            <th>SN</th>
                                            <th>Description of Particular</th>
                                            <th>Quantity</th>
                                            <th>Price / Unit</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($approvedDetailsRequisitions as $key=>$row)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$row->particular}}</td>
                                            <td>{{$row->quantity}}</td>
                                            <td>{{$row->unit}}</td>
                                            <td>{{$row->unit_price}} ৳</td>
                                            <td class="text-left">{{$row->total_price}} ৳</td>
                                            <td></td>
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
{{--                                    <p class="lead">Payment Methods:</p>--}}
{{--                                    <img src="{{ asset('backend/dist/img/credit/visa.png') }}" alt="Visa">--}}
{{--                                    <img src="{{ asset('backend/dist/img/credit/mastercard.png') }}" alt="Mastercard">--}}
{{--                                    <img src="{{ asset('backend/dist/img/credit/american-express.png') }}" alt="American Express">--}}
{{--                                    <img src="{{ asset('backend/dist/img/credit/paypal2.png') }}" alt="Paypal">--}}

{{--                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">--}}
{{--                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem--}}
{{--                                        plugg--}}
{{--                                    </p>--}}
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:47%">Subtotal:</th>
                                                <td>{{ $approvedDetailsRequisitions->sum('total_price') }} ৳</td>
                                            </tr>
                                            <tr>
                                                <th>Tax (0.0%)</th>
                                                <td>00.00</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>{{ $approvedDetailsRequisitions->sum('total_price') }} ৳</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

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
        <!-- /.content -->



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




