@extends('layouts.app')

@section('content')
    {{-- <a href="/posts" class="btn btn-outline-secondary" style = 'margin:12px; margin-left:0px;'>Go Back</a>
    <h1>{{$post->title}}</h1>
    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;">
    <br><br>
    <div>
        {!!$post->body!!}
    </div> --}}

    <div class="col-md-3">
        <div class="card mt-5" style="width: 18rem;">

            <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark text-white">Username - {{Auth::user()->name ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Phone - {{$task->todo ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Gender - {{$task->status  ?? 'N/A'}}</li>
            </ul>
            
        </div>

        
    </div>
    {{-- <h2>{{Auth::user()->tasks}}</h2> --}}

    {{-- <hr> --}}
    {{-- <small>Written on {{$post->created_at}} by {{$post->user->name}}</small> --}}
    {{-- <hr> --}}
    @if(!Auth::guest())
        @if(!Auth::user()->tasks)
            <a href="/tasks/create" class="btn btn-outline-secondary">Update information</a>
        @else
            @if(Auth::user()->id == ($task->user_id ?? 'N/A'))
                <a href="/tasks/{{$task->id}}/edit" class="btn btn-outline-secondary">Edit</a>

                {!!Form::open(['action' => ['App\Http\Controllers\TasksController@destroy', $task->id], 'method'=>'POST', 'class'=>'float-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endif
    @endif
@endsection
