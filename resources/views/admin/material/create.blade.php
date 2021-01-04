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
                        <li class="breadcrumb-item"><a href="{{url('/material')}}">Material</a></li>
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
        <form action="{{route('material.store')}}" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Add Material</h3>
                </div>
                <div class="card-body">

                    <label for="exampleInputDepartmentName">Material Name</label>
                    <input class="form-control @error('material_name') is-invalid @enderror" name="material_name"
                           type="text" placeholder="Material Name">
                    @error('material_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <br>

                    <label for="exampleInputDepartmentName">Select Category</label>
                    <select id="inputStatus" class="form-control custom-select" name="category">
                        <option value="" selected disabled>Select Material Category</option>
                        @foreach(\App\MaterialCategory::all() as $materialcategory)
                            <option value="{{$materialcategory->id}}">{{$materialcategory->name}}</option>
                        @endforeach
                    </select>
                    <br>

                    <label for="exampleDepartmentDetails">Material Unit</label>
                    <input class="form-control @error('unit') is-invalid @enderror" name="unit" type="text"
                           placeholder="Material unit">
                    @error('unit')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>

                    <label for="exampleDepartmentDetails">Material Price</label>
                    <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                           placeholder="Material Price">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>

                    <label for="exampleDepartmentDetails">Material Details</label>
                    <textarea name="details" class="form-control @error('details') is-invalid @enderror" cols="30"
                              rows="5" id=""></textarea>
                    @error('details')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right    ">
                        Submit
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
