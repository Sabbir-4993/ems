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
                                <form action="{{route('permission.store')}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputDesignation">Select Designation</label>
                                            <select class="form-control @error('designation_id') is-invalid @enderror " name="designation_id" id="designation_id"
                                                    required="">
                                                <option value="" selected disabled>Select Designation</option>
                                                @foreach(\App\Designation::all() as $designation)
                                                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUser">Select User</label>
                                            <select class="form-control" name="user_id" id="emp_name" required="">
                                            </select>
                                        </div>

                                        <label for="exampleInputPermission">Permission</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                                <label class="form-check-label" for="checkPermissionAll">Select All</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table id="" class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>Permission</th>
                                                <th>can-add</th>
                                                <th>can-edit</th>
                                                <th>can-delete</th>
                                                <th>can-view</th>
                                                <th>menu</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Department</td>
                                                <td><input type="checkbox" name="name[department]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[department]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[department]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[department]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[department]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Permission</td>
                                                <td><input type="checkbox" name="name[permission]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[permission]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[permission]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[permission]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[permission]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Designation</td>
                                                <td><input type="checkbox" name="name[designation]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[designation]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[designation]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[designation]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[designation]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Employee</td>
                                                <td><input type="checkbox" name="name[user]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[user]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[user]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[user]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[user]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Project</td>
                                                <td><input type="checkbox" name="name[project]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[project]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[project]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[project]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[project]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Project Order</td>
                                                <td><input type="checkbox" name="name[project_work_order]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[project_work_order]['can-edit']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[project_work_order]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[project_work_order]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[project_work_order]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Contractors</td>
                                                <td><input type="checkbox" name="name[contractors]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[contractors]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[contractors]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[contractors]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[contractors]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Contractor Bill</td>
                                                <td><input type="checkbox" name="name[contractor_bill]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[contractor_bill]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[contractor_bill]['can-report']" value="1"> Report</td>
                                                <td><input type="checkbox" name="name[contractor_bill]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[contractor_bill]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Vendor</td>
                                                <td><input type="checkbox" name="name[vendor]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[vendor]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[vendor]['can-delete']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[vendor]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[vendor]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Vendor Bill</td>
                                                <td><input type="checkbox" name="name[vendor_bill]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[vendor_bill]['can-edit']" value="1" disabled></td>
                                                <td><input type="checkbox" name="name[vendor_bill]['can-report']" value="1"> Report</td>
                                                <td><input type="checkbox" name="name[vendor_bill]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[vendor_bill]['can-list']" value="1"></td>
                                            </tr>
                                            <tr>
                                                <td>Material</td>
                                                <td><input type="checkbox" name="name[material]['can-add']" value="1"></td>
                                                <td><input type="checkbox" name="name[material]['can-edit']" value="1"></td>
                                                <td><input type="checkbox" name="name[material]['can-delete']" value="1"></td>
                                                <td><input type="checkbox" name="name[material]['can-view']" value="1"></td>
                                                <td><input type="checkbox" name="name[material]['can-list']" value="1"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
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

            $('#designation_id').on('change', function (e) {

                var designation_id = e.target.value;
                $.ajax({

                    url: "{{ route('permission.getUser')}}",
                    type: "POST",
                    data: {
                        designation_id: designation_id,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (data) {
                        $('#emp_name').empty();
                        $.each(data, function (i, value) {
                            $('#emp_name').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                })
            });
        });
    </script>

    <script>
        $("#checkPermissionAll").click(function () {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            } else {
                // un check all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });

        function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');

            if(groupIdName.is(':checked')){
                classCheckBox.prop('checked', true);
            }else{
                classCheckBox.prop('checked', false);
            }
            implementAllChecked();
        }

        function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);

            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
        }

        {{--function implementAllChecked() {--}}
        {{--    const countPermissions = {{ count($all_permissions) }};--}}
        {{--    const countPermissionGroups = {{ count($permission_groups) }};--}}

        {{--    //  console.log((countPermissions + countPermissionGroups));--}}
        {{--    //  console.log($('input[type="checkbox"]:checked').length);--}}

        {{--    if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){--}}
        {{--        $("#checkPermissionAll").prop('checked', true);--}}
        {{--    }else{--}}
        {{--        $("#checkPermissionAll").prop('checked', false);--}}
        {{--    }--}}
        {{--}--}}
    </script>
@endsection


