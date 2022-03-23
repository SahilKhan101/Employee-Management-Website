@extends('layouts.app')

@section('content')



<body>
    {{-- <h1 class="text-center text-white">Welcome Admin</h1> --}}
    <div class="container">
        {{-- {% for emp in emps %} --}}
        <a href="{{route('user_export')}}" class="btn btn-primary">User-Details CSV</a>
        {{-- <span class="btn-con" style="display:span;">
          <a href="" class="main-btn">
              <span class="btn-text">Download CV</span>
              <span class="btn-icon"><i class="fas fa-download"></i></span>
          </a>
        </span> --}}
        <a href="{{route('task_export')}}" class="btn btn-primary">Tasks CSV</a>
        {{-- <span data-href="/tasks" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export Tasks</span> --}}
        <a href="/tasks/create" class="btn btn-danger float-right">Create New Task</a>
        
        <hr>
        {{-- {% endfor %} --}}

        <table class="table table-dark mt-1">
          <thead>
            <tr>
              <th scope="col">Task Assigned</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
              {{-- {% for task in tasks %} --}}

            {{-- <h2>{{Auth::user()->tasks}}</h2> --}}
            {{-- <h3>{{$tasks}}</h3> --}}
      
            @if(count(Auth::user()->tasks)>0)
              @foreach(Auth::user()->tasks as $task)
                  <tr>
                      <td><p class="text-white">{{$task->todo}}</p></td>
                      <td>
                        {{-- {!! Form::open(['action' => ['App\Http\Controllers\TasksController@edit', $task->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group" style="display: none;">
                                {{Form::label('todo', 'Todo')}}
                                {{Form::text('todo', $task->todo, ['class'=>'form-control', 'placeholder'=>'Todo'])}}
                            </div>
                            <div class="form-group" style="display: none;">
                                {{Form::label('status', 'Status')}}
                                {{Form::text('status', 'Completed', ['class'=>'form-control', 'placeholder'=>'Status'])}}
                            </div>
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Task Completed', ['class'=>'btn btn-danger'])}}
                        {!! Form::close() !!} --}}
                        <a href="/tasks/{{$task->id}}/edit" class="btn btn-secondary">Edit Task</a>
                      </td>

                      <td>
                        {!!Form::open(['action' => ['App\Http\Controllers\TasksController@destroy', $task->id], 'method'=>'POST', 'class'=>'float-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                      </td>
                  </tr>
              @endforeach
            @endif
      
      
          </tbody>
        </table>


      {{-- ------------------------------------------------------------------------------------- --}}


        <table class="table table-dark mt-1">
          <thead>
            <tr>
              <th scope="col">Employee Name</th>
              <th scope="col">Email</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
              {{-- {% for task in tasks %} --}}

            {{-- <h2>{{Auth::user()->tasks}}</h2> --}}
            {{-- <h3>{{$users}}</h3> --}}
      
            @if(count($users)>0)
              @foreach($users as $user)
                @if($user->user_type != 'Administrator')
                  <tr>
                      <td><p class="text-white">{{$user->name}}</p></td>
                      <td><p class="text-white">{{$user->email}}</p></td>

                      <td>
                        @if(($user->profiles->id ?? Null) == Null)
                          <a href="" class="btn btn-secondary">Profile N/A</a>
                        @else
                          <a href="/profiles/{{$user->profiles->id ?? Null}}" class="btn btn-secondary">View Profile</a>
                        @endif
                      </td>

                      <td>
                        {!!Form::open(['action' => ['App\Http\Controllers\UserController@destroy', $user->id], 'method'=>'POST', 'class'=>'float-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                        {{-- <a href="" onclick="function(){ {{$user->delete();}} }" class="btn btn-secondary">Delete User</a> --}}
                      </td>
                  </tr>
                @endif
              @endforeach
            @endif
      
      
          </tbody>
        </table>


    </div>



<script>
  function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
  }
</script>

</body>


@endsection
