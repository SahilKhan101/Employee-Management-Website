@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1> 
    {!! Form::open(['action' => ['App\Http\Controllers\ProfilesController@update', $profile->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{-- <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div> --}}
        <div class="form-group">
            {{Form::label('phone', 'Phone')}}
            {{Form::text('phone', $profile->phone, ['class'=>'form-control', 'placeholder'=>'Phone'])}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Age')}}
            {{Form::text('age', $profile->age, ['class'=>'form-control', 'placeholder'=>'Age'])}}
        </div>
        <div class="form-group">
            {{Form::label('gender', 'Gender')}}
            {{Form::text('gender', $profile->gender, ['class'=>'form-control', 'placeholder'=>'Gender'])}}
        </div>
        <div class="form-group">
            {{Form::label('company', 'Company')}}
            {{Form::text('company', $profile->company, ['class'=>'form-control', 'placeholder'=>'Company'])}}
        </div>
        <div class="form-group">
            {{Form::label('address', 'Address')}}
            {{Form::text('address', $profile->address, ['class'=>'form-control', 'placeholder'=>'Address'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div> --}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
