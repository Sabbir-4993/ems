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

                                        <label for="exampleInputPermission">Permission</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                                <label class="form-check-label" for="checkPermissionAll">Select All</label>
                                            </div>
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
                                                    <th>menu</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Department</td>
                                                    <td><input type="checkbox" name="name[department][can-add]" @if(isset($permission['name']['department']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-edit]" @if(isset($permission['name']['department']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-delete]" @if(isset($permission['name']['department']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[department][can-view]" @if(isset($permission['name']['department']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[department][can-list]" @if(isset($permission['name']['department']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Permission</td>
                                                    <td><input type="checkbox" name="name[permission][can-add]" @if(isset($permission['name']['permission']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[permission][can-edit]" @if(isset($permission['name']['permission']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[permission][can-delete]" @if(isset($permission['name']['permission']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[permission][can-view]" @if(isset($permission['name']['permission']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[permission][can-list]" @if(isset($permission['name']['permission']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Designation</td>
                                                    <td><input type="checkbox" name="name[designation][can-add]" @if(isset($permission['name']['designation']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[designation][can-edit]" @if(isset($permission['name']['designation']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[designation][can-delete]" @if(isset($permission['name']['designation']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[designation][can-view]" @if(isset($permission['name']['designation']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[designation][can-list]" @if(isset($permission['name']['designation']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Employee</td>
                                                    <td><input type="checkbox" name="name[user][can-add]" @if(isset($permission['name']['user']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[user][can-edit]" @if(isset($permission['name']['user']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[user][can-delete]" @if(isset($permission['name']['user']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[user][can-view]" @if(isset($permission['name']['user']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[user][can-list]" @if(isset($permission['name']['user']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td><input type="checkbox" name="name[project][can-add]" @if(isset($permission['name']['project']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[project][can-edit]" @if(isset($permission['name']['project']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[project][can-delete]" @if(isset($permission['name']['project']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[project][can-view]" @if(isset($permission['name']['project']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[project][can-list]" @if(isset($permission['name']['project']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Project Order</td>
                                                    <td><input type="checkbox" name="name[project_work_order][can-add]" @if(isset($permission['name']['project_work_order']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[project_work_order][can-edit]" @if(isset($permission['name']['project_work_order']['can-edit'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[project_work_order][can-delete]" @if(isset($permission['name']['project_work_order']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[project_work_order][can-view]" @if(isset($permission['name']['project_work_order']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[project_work_order][can-list]" @if(isset($permission['name']['project_work_order']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Contractors</td>
                                                    <td><input type="checkbox" name="name[contractors][can-add]" @if(isset($permission['name']['contractors']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[contractors][can-edit]" @if(isset($permission['name']['contractors']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[contractors][can-delete]" @if(isset($permission['name']['contractors']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[contractors][can-view]" @if(isset($permission['name']['contractors']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[contractors][can-list]" @if(isset($permission['name']['contractors']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Contractor Bill</td>
                                                    <td><input type="checkbox" name="name[contractor_bill][can-add]" @if(isset($permission['name']['contractor_bill']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[contractor_bill][can-edit]" @if(isset($permission['name']['contractor_bill']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[contractor_bill][can-report]" @if(isset($permission['name']['contractor_bill']['can-report'])) checked @endif value="1"> Report</td>
                                                    <td><input type="checkbox" name="name[contractor_bill][can-view]" @if(isset($permission['name']['contractor_bill']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[contractor_bill][can-list]" @if(isset($permission['name']['contractor_bill']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Vendor</td>
                                                    <td><input type="checkbox" name="name[vendor][can-add]" @if(isset($permission['name']['vendor']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[vendor][can-edit]" @if(isset($permission['name']['vendor']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[vendor][can-delete]" @if(isset($permission['name']['vendor']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[vendor][can-view]" @if(isset($permission['name']['vendor']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[vendor][can-list]" @if(isset($permission['name']['vendor']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Vendor Bill</td>
                                                    <td><input type="checkbox" name="name[vendor_bill][can-add]" @if(isset($permission['name']['vendor_bill']['can-add'])) checked @endif value="1" ></td>
                                                    <td><input type="checkbox" name="name[vendor_bill][can-edit]" @if(isset($permission['name']['vendor_bill']['can-edit'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[vendor_bill][can-report]" @if(isset($permission['name']['vendor_bill']['can-report'])) checked @endif value="1"> Report</td>
                                                    <td><input type="checkbox" name="name[vendor_bill][can-view]" @if(isset($permission['name']['vendor_bill']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[vendor_bill][can-list]" @if(isset($permission['name']['vendor_bill']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Material</td>
                                                    <td><input type="checkbox" name="name[material][can-add]" @if(isset($permission['name']['material']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[material][can-edit]" @if(isset($permission['name']['material']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[material][can-delete]" @if(isset($permission['name']['material']['can-delete'])) checked @endif value="1" disabled></td>
                                                    <td><input type="checkbox" name="name[material][can-view]" @if(isset($permission['name']['material']['can-view'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[material][can-list]" @if(isset($permission['name']['material']['can-list'])) checked @endif value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Requisition</td>
                                                    <td><input type="checkbox" name="name[requisition][can-add]" @if(isset($permission['name']['requisition']['can-add'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[requisition][can-edit]" @if(isset($permission['name']['requisition']['can-edit'])) checked @endif value="1"></td>
                                                    <td><input type="checkbox" name="name[requisition][can-pending]" @if(isset($permission['name']['requisition']['can-pending'])) checked @endif value="1"> Pending</td>
                                                    <td><input type="checkbox" name="name[requisition][can-approve]" @if(isset($permission['name']['requisition']['can-approve'])) checked @endif value="1"> Approve</td>
                                                    <td><input type="checkbox" name="name[requisition][can-list]" @if(isset($permission['name']['requisition']['can-list'])) checked @endif value="1"></td>
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


