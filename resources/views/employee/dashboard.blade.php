@extends('layouts.app')

@section('content')

<h1 class="text-center" style="color: antiquewhite;">Welcome</h1>
<table class="table table-dark mt-1">
    <thead>
      <tr>
        <th scope="col">Task Assigned</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        {{-- {% for task in tasks %} --}}

      @if(count($tasks)>0)
        @foreach($tasks as $task)
          @if($task->status == 'Incomplete')
            <tr>
                <td><p class="text-white">{{$task->todo}}</p></td>
                <!-- <td> <a class="btn btn-outline-danger" id="status">Completed</a> </td> -->
                <td>
                {{-- <a href="/tasks/{{$task->id}}/delete" class="btn btn-outline-danger">Task Completed</a> --}}
                  {{-- {!!Form::open(['action' => ['App\Http\Controllers\ProfilesController@destroy', $profile->id], 'method'=>'POST', 'class'=>'float-right'])!!}
                      {{Form::hidden('_method', 'DELETE')}}
                      {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                  {!!Form::close()!!} --}}
                  {!! Form::open(['action' => ['App\Http\Controllers\TasksController@update', $task->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                  {!! Form::close() !!}
                </td>
            </tr>
          @endif
        @endforeach
      {{-- @else
        <tr>
            <td><p class="text-white">No Tasks to do</p></td>
        </tr> --}}
      @endif


    </tbody>
  </table>
<script>
   
  all_tasks = document.querySelectorAll("#status")
  for(i=0;i<all_tasks.length;i++){
      all_tasks[i].addEventListener("click",function(){
          var td = this.parentElement;
          td.parentElement.classList.add("d-none");
      })
  }

</script>

@endsection
