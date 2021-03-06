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
                        <li class="breadcrumb-item"><a href="{{url('/category')}}">Category</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <form action="{{route('category.store')}}" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>
                <div class="card-body">
                    <label for="exampleInputDepartmentName">Category Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <br>
                    <label for="exampleDepartmentDetails">Category Details</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" id=""></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right    ">
                        Submit
                    </button>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </div>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection

@push('script')
@endpush
