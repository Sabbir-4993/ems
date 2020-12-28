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
                        {{--                        <li class="breadcrumb-item"><a href="{{route('requistion.store')}}">Requisition</a></li>--}}
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- page title area end -->

    <!-- Main content -->
    <section id="" class="content">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
            </div>
        @endif
        <form action="{{route('requisition.store')}}" method="post">
           @csrf
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Requisition Added</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">Select Project</label>
                                <select class="form-control" name="project_id">
                                    <option selected disabled>Select Project</option>
                                    @foreach(\App\Project::all() as $projects)
                                        <option value="{{$projects->id}}">{{$projects->project_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputRequisition">Requisition No.</label>
                                <input type="text" name="requisition_no" class="form-control"
                                       id="exampleInputRequisition" required=""
                                       placeholder="Enter Requisition No.">
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-8">
                <!-- Form Element sizes -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Requisition Details</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputmaterial">Requisition Details</label>
                            {{--                                <input type="text" name="email" class="form-control" id="exampleInputEmail" required=""--}}
                            {{--                                       placeholder="Enter Email Address">--}}
                            <form enctype="multipart/form-data">
                                <table class="table table-bordered" id="tbl_posts">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Post Name</th>
                                        <th>No. of Vacancies</th>
                                        <th>Age</th>
                                        <th>Pay Scale</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbl_posts_body">
                                    <tr id="rec-1">
                                        <td><span class="sn">1</span>.</td>
                                        <td>Sanitary Inspector</td>
                                        <td>02</td>
                                        <td>21 to 42 years</td>
                                        <td>5200-20200/-</td>
                                        <td><a class="btn btn-xs delete-record" data-id="1"><i
                                                    class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <tr id="rec-2">
                                        <td><span class="sn">2</span>.</td>
                                        <td>Tax & Revenue Superintendent</td>
                                        <td>02</td>
                                        <td>21 to 42 years</td>
                                        <td>5200-20200/-</td>
                                        <td><a class="btn btn-xs delete-record" data-id="2"><i
                                                    class="fas fa-trash"></i></a></td>
                                    </tr>

                                    <tr id="rec-3">
                                        <td><span class="sn">3</span>.</td>
                                        <td>Tax & Revenue Inspector</td>
                                        <td>04</td>
                                        <td>21 to 42 years</td>
                                        <td>5200-20200/-</td>
                                        <td><a class="btn btn-xs delete-record" data-id="3"><i
                                                    class="fas fa-trash"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div style="display:none;">
                                    <table id="sample_table">
                                        <tr id="">
                                            <td><span class="sn"></span>.</td>
                                            <td>ABC Posts</td>
                                            <td>04</td>
                                            <td>21 to 42 years</td>
                                            <td>5200-20200/-</td>
                                            <td><a class="btn btn-xs delete-record" data-id="0"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="well clearfix">
                                    <a class="btn btn-primary pull-right add-record" data-added="0"><i class="glyphicon glyphicon-plus"></i>Add Row</a>
                                </div>
                            </form>
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
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        jQuery(document).delegate('a.add-record', 'click', function(e) {
            e.preventDefault();
            var content = jQuery('#sample_table tr'),
                size = jQuery('#tbl_posts >tbody >tr').length,
                element = content.clone();
            element.attr('id', 'rec-'+size);
            element.find('.delete-record').attr('data-id', size);
            element.appendTo('#tbl_posts_body');
            element.find('.sn').html(size+1);
        });

        jQuery(document).delegate('a.delete-record', 'click', function(e) {
            e.preventDefault();
            var didConfirm = confirm("Are you sure You want to delete");
            if (didConfirm == true) {
                var id = jQuery(this).attr('data-id');
                var targetDiv = jQuery(this).attr('targetDiv');
                jQuery('#rec-' + id).remove();

                //regnerate index number on table
                $('#tbl_posts_body tr').each(function(index) {
                    //alert(index);
                    $(this).find('span.sn').html(index+1);
                });
                return true;
            } else {
                return false;
            }
        });
    </script>

@endsection