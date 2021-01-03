@extends('admin.layouts.master')
<style>
    #invoice{
        position: center;

    }

    .invoice {
        position: relative;
        background-color: #f4f6f9;
        min-height: 500px;
    }

    .invoice .company-details {
        text-align: right;
        margin-bottom: 20px;
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0;
    }

    .invoice .contacts {
        margin-top: 20px;
    }

    .invoice .invoice-to {
        float: left;
    }

    .invoice .invoice-to .to {
        margin-top: 0px;
        margin-bottom: 0px;
        padding: 0px;
    }
    .invoice main {
        padding-bottom: 50px
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        border: 1px solid black;

    }
    .invoice table th {
        background: #eee;
        white-space: nowrap;
        font-weight: 700;
        font-size: 14px;
        border: 1px solid #5a5a5a;
        height: 25px;
        text-align: center;
    }

    .invoice table td {
        background: #fff;
        border: 1px solid #5a5a5a;
        font-size: 14px;
        color: black;
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 14px;
        border-top: 1px solid black
    }

    .invoice table tfoot tr:first-child td {
        border: 1px solid black
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid black;
    }

    .invoice table tfoot tr td:first-child {
        border: 1px solid black
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 5px solid #5a5a5a;
        padding: 8px 0px;
    }
    .logo{
        height: 75px;
        width: 250px;
    }
    .empty{
        height: 75px;
    }

    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important;
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>

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
    <div class="toolbar hidden-print">
        <div class="text-center">
            <button id="printInvoice" onclick="PrintDiv()" class="btn btn-info"><i class="fa fa-print"></i>Print</button>
        </div>
    </div>
    <br>
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div class="container col-md-8">
                @foreach($approvedDetailsRequisitions as $key=>$row)

                <?php
                $projectDetails =\App\Project::where('id',$row->project_id)->first();
                ?>
                @endforeach
                <header>
                    <div class="row">
                        <div class="col-8">
                            <h4 class="name" style="color: #0C9A9A">
                                @php
                                    $users = \App\User::where('id',$row->user_id)->first();
                                @endphp
                                REQUISITION FORM:
                            </h4>
                            <div class="col">
                                <div class="row">
                                    <span>REQ NO:</span><span> TAE / Procurement / 2020 _/<strong>{{$row->req_no}}</strong></span>
                                </div>
                                <div class="row">
                                    <span>Ref./Work Order: </span><strong>{{$projectDetails->project_ref}}</strong>
                                </div>
                                <div class="row">
                                    <h6 class="to">Date: <span>{{$row->requisition_date}}</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 company-details">
                            <a target="_blank" href="{{'/'}}">
                                <img src="{{ asset('uploads/company_logo/logo.png') }}"></a>                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light"><u>Requisition Details:</u></div>
                            <div class=" row ">
                                <div class="col">
                                    <p class="to">Project Name: <strong>{{$projectDetails->project_name}} </strong></p>
                                </div>
                                <div class="col">
                                    <p class="to float-right">Date: <span>{{$row->requisition_date}}</span></p>
                                </div>

                            </div>

                            <div class=" row ">
                                <div class="col">
                                    <p class="to"> PCO: <span>{{$users->name}}</span></p>
                                </div>
                                <div class="col">
                                    <p class="float-right">Contact No. <span>{{$users->mobile_number}}</span></p>
                                </div>
                            </div>
                            <div >
                                <div class="col">
                                    <p class="float-left"> Project Address: <span>{{$projectDetails->address}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Description of Particular</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price / Unit</th>
                            <th>Total Price  </th>
                            <th>  Remarks</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($approvedDetailsRequisitions as $key=>$row)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td class="text-center">
                                    {{$row->particular}}
                                </td>
                                <td class="text-center">
                                    {{$row->quantity}}
                                </td>
                                <td class="text-center">
                                    {{$row->unit}}
                                </td>
                                <td class="text-center">
                                    {{$row->unit_price}}
                                </td >
                                <td class="text-center">
                                    {{$row->total_price}}
                                </td >
                                <td >
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="empty"></div>
                    <div class="row">
                        <div class="col" style="text-align: center; text-decoration: overline;">Prepared BY</div>
                        <div class="col" style="text-align: center; text-decoration: overline;">Received BY</div>
                        <div class="col" style="text-align: center; text-decoration: overline;">Approved BY</div>
                    </div>
                </main>
            </div>
        </div>
    </div>




@endsection
@section('script')
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




