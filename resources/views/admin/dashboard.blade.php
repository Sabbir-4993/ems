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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{route('requisition.pending')}}" class="small-box-footer">
                    <div class="small-box bg-info">
                        <div class="inner">
                            @php
                                use Illuminate\Support\Facades\DB;
                                $requisition = count(DB::table('requisitions')->where('status','0')->get());
                            @endphp
                            <h1>{{$requisition}} </h1>
                            <p>Pending Requisition</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{route('project.index')}}" class="small-box-footer">
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $project = count(\App\Project::all());
                            @endphp
                            <h1>{{$project}} </h1>
                            <p>Project</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
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

                        </div>                                        <!-- /.card-body -->
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
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
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
                        <input class="form-control" id="todo_details" name="todo_details" placeholder="Enter Todo details " type="text" required="">

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

    <!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')
    <script type='text/javascript'>
        $(document).ready(function(){
            // Add record
            $('#addTodo').on('submit',function (e){
                e.preventDefault();
                $.ajax({
                    type:"post",
                    url:"{{route('todo.store')}}",
                    data:$('#addTodo').serialize(),
                    success:function (response) {
                        $('#modal-m').modal('hide')
                        alert("TODO Save Successfully");
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

