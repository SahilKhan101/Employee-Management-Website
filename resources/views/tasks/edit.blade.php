@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1> 
    {!! Form::open(['action' => ['App\Http\Controllers\TasksController@update', $task->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @if(Auth::user()->user_type == 'Administrator')
            <div class="form-group">
                {{Form::label('todo', 'Todo')}}
                {{Form::text('todo', $task->todo, ['class'=>'form-control', 'placeholder'=>'Todo'])}}
            </div>
            <div class="form-group" style="display: none;">
                {{Form::label('status', 'Status')}}
                {{Form::text('status', $task->status, ['class'=>'form-control', 'placeholder'=>'Status'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-outline-primary'])}}
        @else
            <div class="form-group" style="display: none;">
                {{Form::label('todo', 'Todo')}}
                {{Form::text('todo', $task->todo, ['class'=>'form-control', 'placeholder'=>'Todo'])}}
            </div>
            <div class="form-group">
                {{Form::label('status', 'Status')}}
                {{Form::text('status', 'Completed', ['class'=>'form-control', 'placeholder'=>'Status'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-outline-primary'])}}
        @endif
    {!! Form::close() !!}
@endsection
