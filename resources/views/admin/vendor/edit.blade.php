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
                        <li class="breadcrumb-item"><a href="{{url('/vendor')}}">vendor</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section id="" class="content">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
                </div>
            @endif
            <form action="{{route('vendor.update',[$vendors->id])}}" method="post">
                @csrf
                {{method_field('PATCH')}}
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Add vendor</h3>
                    </div>
                    <div class="card-body">
                        <label for="exampleInputDepartmentName">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="" value="{{$vendors->vendor_name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                        <label for="exampleInputDepartmentName"> Number</label>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" value="{{$vendors->vendor_phone}}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                        <br>
                        <label for="exampleInputDepartmentName"> Address</label>
                        <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" value="{{$vendors->vendor_address}}">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                        <br>
                        <label for="exampleInputDepartmentName"> Refer by</label>
                        <input class="form-control @error('referBy') is-invalid @enderror" name="referBy" type="text" value="{{$vendors->assign_by}}">
                        @error('referBy')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                        <br>
                        <label for="exampleInputDepartmentName"> Details</label>
                        <input class="form-control @error('details') is-invalid @enderror" name="details" type="text" value="{{$vendors->vendor_details}}">
                        @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            Update
                        </button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>


@endsection
