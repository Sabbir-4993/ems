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
        <form action="{{route('category.update', [$category->id])}}" method="post">
            @csrf
            {{method_field('PATCH')}}
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Update Category</h3>
                </div>
                <div class="card-body">
                    <label for="exampleInputDepartmentName">Category Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{$category->cat_name}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="card-body">
                    <label for="exampleDepartmentDetails">Category Details</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5"> {{$category->cat_description}}
                    </textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="card-footer">
                    <a href="{{url('category')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">
                        Update
                    </button>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
