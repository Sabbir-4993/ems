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
                        <li class="breadcrumb-item"><a href="{{url('/employee')}}">Employee</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="container-fluid">
            <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Employee Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form >
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="exampleInputName" required=""
                                               placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="exampleInputName" required=""
                                               placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNumber">Phone Number</label>
                                        <input type="text" name="mobile_number" class="form-control" id="exampleInputNumber" required=""
                                               placeholder="Enter Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAddress">Address</label>
                                        <input type="text" name="address" class="form-control" id="exampleInputAddress" required=""
                                               placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBlood">Blood Group</label>
                                        <select id="inputStatus" class="form-control custom-select" name="blood_group"
                                                required="" >
                                            <option selected disabled>Select Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAddress">Join Date</label>
                                        <input class="form-control" type="date"  id="join_date" name="join_date" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputSalary">Salary</label>
                                        <input type="text" name="salary" class="form-control" id="exampleInputSalary" required=""
                                               placeholder="Enter Basic Salary">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image Upload</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">
                        <!-- Form Element sizes -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Official Information</h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email Address</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail" required=""
                                           placeholder="Enter Email Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1" required=""
                                           placeholder="Password">
                                    <i class="far fa-eye" id="togglePassword" style="margin-top: -26px;margin-right: 10px; cursor: pointer;float: right;" onclick="passShow()"></i>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- Form Element sizes -->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Department Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select id="inputStatus" class="form-control custom-select" name="department_id"
                                            required="">
                                        <option value="" selected disabled>Select Department</option>

                                        @foreach(\App\Department::all() as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Designation</label>
                                    <select class="form-control" name="designation" id="" required="">
                                        <option value="" selected disabled>Select Designation</option>

                                        @foreach(\App\Designation::all() as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Employee Type</label>
                                    <select class="form-control" name="emp_type" id="" required="">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="1">Full Time</option>
                                        <option value="0">Part Time</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Employee Status</label>
                                    <select class="form-control" name="emp_status" id="" required="">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                    <div class="col-md-12">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-info float-right">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script type="text/javascript">
        var password = document.getElementById("password")
        var confirm_password = document.getElementById("confirmPassword");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

    <script>
        function passShow() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
        function confirmPassShow() {
            var pass = document.getElementById("confirmPassword");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
