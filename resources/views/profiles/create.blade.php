@extends('layouts.app')

@section('content')
    <h1>Post</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\ProfilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('phone', 'Phone')}}
            {{Form::text('phone', '', ['class'=>'form-control', 'placeholder'=>'Phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Age')}}
            {{Form::text('age', '', ['class'=>'form-control', 'placeholder'=>'Age'])}}
        </div>
        <div class="form-group">
            {{Form::label('gender', 'Gender')}}
            {{Form::text('gender', '', ['class'=>'form-control', 'placeholder'=>'Gender'])}}
        </div>
        <div class="form-group">
            {{Form::label('company', 'Company')}}
            {{Form::text('company', '', ['class'=>'form-control', 'placeholder'=>'Company'])}}
        </div>
        <div class="form-group">
            {{Form::label('address', 'Address')}}
            {{Form::text('address', '', ['class'=>'form-control', 'placeholder'=>'Address'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div> --}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
