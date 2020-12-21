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
                        <li class="breadcrumb-item"><a href="{{url('/category/create')}}">Create</a></li>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Department List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Category Name</th>
                                    <th>CategoryDetails</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($categories)>0)
                                    @foreach($categories as $key => $row)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$row->cat_name}}</td>
                                            <td>{{$row->cat_description}}</td>
                                            <td>
                                                <a class="btn btn-block bg-gradient-secondary btn-xs" href="{{route('category.edit',[$row->id])}}"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-block bg-gradient-danger btn-xs" data-toggle="modal" data-target="#modal-sm{{$row->id}}">Delete</button>
                                                <!-- /.modal -->
                                                <div class="modal fade" id="modal-sm{{$row->id}}">
                                                    <div class="modal-dialog modal-sm">
                                                        <form action="{{route('category.destroy',[$row->id])}}" method="post">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete Confirm!!</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Do you Want to Delete ?</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal End -->
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td>No Department to Display</td>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Category Name</th>
                                    <th>CategoryDetails</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

