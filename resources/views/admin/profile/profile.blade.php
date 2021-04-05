@extends('admin.layouts.master')

@section('content')

    <!-- Main content --><br><br><br>
    <section class="content">
        @if(Session::has('message'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-widget widget-user shadow">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username"></h3>
                                <h5 class="widget-user-desc">

                                </h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="{{asset('uploads/profile')}}/{{$user->image}}" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$user->name}}</h5>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$user->mobile_number}}</h5>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$user->blood_group}}</h5>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="container">
                                        <a href="tel:" style="font-size: 16px;" class="btn btn-primary btn-block">
                                            <i class="fas fa-phone"></i>
                                            Call {{$user->mobile_number}}
                                        </a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Email</strong>

                                <p class="text-muted">
                                    {{$user->email}}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">
                                    {{$user->address}}
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active " href="#settings" data-toggle="tab">Settings</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                        <form action="{{route('profile.resetPassword')}}" method="post" class="form-horizontal">
                                            @csrf
{{--                                            <input type="hidden" name="id" value="{{$user->id}}">--}}
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name"class="form-control" id="inputName2" value="{{$user->name}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email"class="form-control" id="inputEmail" value="{{$user->email}}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Current Password</label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span toggle="#OldPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                        </div>
                                                    </div>
{{--                                                    <input id="password-field" value="" type="password" class="form-control" />--}}
                                                    <input class="form-control" name="OldPassword" id="OldPassword" type="password" placeholder="Old Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label"> Password</label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Confirm Password</label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                                                </div>
                                                <span id='message'></span>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('script')
    <script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Password Match').css('color', 'green');
            } else
                $('#message').html('Password Not Match').css('color', 'red');
        });
    </script>
    <script>
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password"){
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
