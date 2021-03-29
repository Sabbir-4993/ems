@extends('admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('requisition.pending')}}" class="small-box-footer">

                    <div class="info-box shadow">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pending Requisition</span>
                            <span class="info-box-number">
                              @php
                                  use Illuminate\Support\Facades\DB;
                                  $requisition = count(DB::table('requisitions')->where('status','0')->get());
                              @endphp
                              <small>{{$requisition}} </small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                <a href="{{route('project.index')}}" class="small-box-footer">
                    <div class="info-box mb-3 shadow">
                        @php
                            $project = count(\App\Project::all());
                        @endphp
                        <span class="info-box-icon bg-danger elevation-1"><i class="ion ion-stats-bars"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Project</span>
                            <span class="info-box-number">{{$project}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('employee.index')}}" class="small-box-footer">
                    <div class="info-box mb-3 shadow">
                        @php
                            $employee = count(\App\User::all());
                        @endphp
                        <span class="info-box-icon bg-success elevation-1"><i class="ion ion-person-add"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Employee</span>
                            <span class="info-box-number">{{$employee}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 shadow">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </div>
    </section >

    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                To Do List
                            </h3>
                        </div>
                        @php
                        use App\Model\Todo;
                        $todos = Todo::where('employee_id',Auth()->id())->get();
                        @endphp
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list" data-widget="todo-list">
                                @foreach($todos as $todo)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                      <i class="fas fa-ellipsis-v"></i>
                                      <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->
                                    <div  class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="" name="todo{{$todo->id}}" id="todoCheck{{$todo->id}}" >
                                        <label for="todoCheck{{$todo->id}}"></label>
                                    </div>
                                    <!-- todo text -->
                                    <span class="text">{{$todo->work_description}}</span>
                                    <!-- Emphasis label -->
                                    <small class="badge badge-danger"><i class="far fa-clock"></i> {{$todo->created_at->diffForHumans()}}</small>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="{{route('todo.delete',$todo->id)}}" style="color: red">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                                <a class="btn btn-info float-right" href="#" data-toggle="modal"
                                   data-target="#modal-m">
                                    <i class="fas fa-plus"></i>
                                    Add TODO
                                </a>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                    <!-- Calendar -->
                    <div class="card bg-gradient-gray-dark">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Map card -->
                    <div class="card bg-gradient-gray-dark">
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white">Visitors</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white">Online</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white">Sales</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <div class="modal fade" id="modal-m">
        <div class="modal-dialog modal-m">
            <form  id="addTodo">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ADD TODO LIST !!</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInput">TODO Title  </label>
                        <input class="form-control" id="todo_title" name="todo_title" type="text" placeholder="Enter Todo Title " required="">
                        <br>
                        <label for="exampleInput">Details</label>
                        <textarea class="form-control" id="todo_details" name="todo_details" type="text" required=""></textarea>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-danger">Add Todo</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
        </div>
    </section >

    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <script type='text/javascript'>
        $(document).ready(function(){
            // Add record
            $('#addTodo').on('submit',function (e){
                // e.preventDefault();
                $.ajax({
                    type:"post",
                    url:"{{route('todo.store')}}",
                    data:$('#addTodo').serialize(),
                    success:function (response) {
                        $('#modal-m').modal('hide')
                        document.getElementById("addTodo").reset();
                    },
                    error:function (error){
                        alert("TODO Not saved")
                    }
                })
            })

        });
    </script>
@endsection

