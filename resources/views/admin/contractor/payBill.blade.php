
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
                        <li class="breadcrumb-item"><a href="{{url('/contractors')}}">Contractor</a></li>
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
            <div class="container">
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
                    </div>
                @endif
                <form action="{{route('contractors.billPaid')}}" method="post">
                    @csrf
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Pay Bill</h3>
                        </div>
                        <div class="card-body">
                            <label for="exampleInputDepartmentName">Pay Amount</label>
                            <input class="form-control @error('pay') is-invalid @enderror" name="pay" type="text" placeholder="Enter Pay Amount" required>
                            @error('pay')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                            <br>
                            <label for="billing_date" class="col-form-label"> Billing Date</label>
                            <input class="form-control" type="date"  id="billing_date" name="billing_date" required>
                            @error('billing_date')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <input type="hidden" name="id" value="{{$contractors->id}}">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right    ">
                                Pay Bill
                            </button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
            </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

