@extends('admin.layouts.master')
@include('admin.layouts.scripts')

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
                        <li class="breadcrumb-item"><a href="{{route('permission.index')}}">Permission</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
                            </div>
                        @endif
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">Create Permission</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form action="{{route('permission.update', $permission->id)}}" method="POST">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <div class="card-body">

                                        <div class="form-group">
                                           <h4>{{$permission->user->name}}</h4>
                                           <strong>{{$permission->designation->name}}</strong>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPermission">Permission</label>
                                            <table id="example2" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Permission</th>
                                                    <th>can-add</th>
                                                    <th>can-edit</th>
                                                    <th>can-delete</th>
                                                    <th>can-view</th>
                                                    <th>can-list</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Department</td>
                                                    <td><input type="checkbox" name="name[department][can-add]" @if(isset($permission['name']['department']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-edit]" @if(isset($permission['name']['department']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-delete]" @if(isset($permission['name']['department']['can-delete'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-view]" @if(isset($permission['name']['department']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-list]" @if(isset($permission['name']['department']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Update</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
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
@endsection

@section('css')

@endsection
@section('script')
    <script>
        // for project
        $(document).ready(function () {

            $('#designation_id').on('change',function(e) {

                var designation_id = e.target.value;
                $.ajax({

                    url:"{{ route('permission.getUser')}}",
                    type:"POST",
                    data: {
                        designation_id: designation_id,
                        _token: '{{csrf_token()}}',
                    },
                    success:function (data) {
                        $('#emp_name').empty();
                        $.each(data, function(i, value) {
                            $('#emp_name').append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                })
            });
        });
    </script>

    <script>
        $("#checkPermissionAll").click(function(){
            if($(this).is(':checked')){
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            }else{
                // un check all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    </script>
@endsection


