@extends('layouts.app')

@section('content')
    <h1>Post</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\TasksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('todo', 'Task')}}
            {{Form::text('todo', '', ['class'=>'form-control', 'placeholder'=>'Task'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::label('age', 'Age')}}
            {{Form::text('age', '', ['class'=>'form-control', 'placeholder'=>'Age'])}}
        </div> --}}
        {{Form::submit('Submit', ['class'=>'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
