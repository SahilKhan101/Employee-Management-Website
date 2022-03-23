@extends('layouts.app')

@section('content')
    {{-- <a href="/posts" class="btn btn-outline-secondary" style = 'margin:12px; margin-left:0px;'>Go Back</a>
    <h1>{{$post->title}}</h1>
    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;">
    <br><br>
    <div>
        {!!$post->body!!}
    </div> --}}

    {{-- <div class="col-md-3 blogs-content">
        <div class="card mt-5 blog" style="width: 18rem;">
            <img class="card-img-top" src="/storage/cover_images/{{$profile->cover_image}}" alt="Card image cap" width="200px ">
            
            <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark text-white">Username - {{$profile->user->name ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Phone - {{$profile->phone ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Gender - {{$profile->gender  ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Age - {{$profile->age ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Company - {{$profile->company ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Address - {{$profile->address ?? 'N/A'}}</li>
            </ul>
            
        </div>        
    </div> --}}

    {{-- <div class="blogs-content">
        <div class="main-title">
            <h2>My <span>Blogs</span><span class="bg-text">My Blogs</span></h2>
        </div> --}}
        <div class="blogs" style="margin-top:0 !important; margin:0 auto; font-size:13px; color:#FFFFFF;">
            <div class="blog">
                <img src="/storage/cover_images/{{$profile->cover_image}}" style="width: 100%" alt="">
                <div class="blog-text center justify-content-center">
                    <h4 class="center justify-content-center" style="align:center;">
                        {{$profile->user->name ?? 'N/A'}}
                    </h4>
                    {{-- <p> --}}
                        <ul class="list-group list-group-flush">
                            {{-- <li class="list-group-item bg-dark text-white">Username - {{Auth::user()->name ?? 'N/A'}}</li> --}}
                            {{-- <li class="list-group-item bg-dark text-white">Username - {{$profile->user->name ?? 'N/A'}}</li> --}}
                            <li class="list-group-item bg-dark text-white">Phone - {{$profile->phone ?? 'N/A'}}</li>
                            <li class="list-group-item bg-dark text-white">Gender - {{$profile->gender  ?? 'N/A'}}</li>
                            <li class="list-group-item bg-dark text-white">Age - {{$profile->age ?? 'N/A'}}</li>
                            <li class="list-group-item bg-dark text-white">Company - {{$profile->company ?? 'N/A'}}</li>
                            <li class="list-group-item bg-dark text-white">Address - {{$profile->address ?? 'N/A'}}</li>
                        </ul>
                        @if(!Auth::guest())
                            @if(!Auth::user()->profiles)
                                <a href="/profiles/create" class="btn btn-outline-secondary">Update information</a>
                            @else
                                @if(Auth::user()->id == ($profile->user_id ?? 'N/A'))
                                <div class="justify-content-center">
                                    <a href="/profiles/{{$profile->id}}/edit" class="btn btn-primary" style="margin: 0 auto; align:center;">Edit</a>

                                </div>
                    
                                    {{-- {!!Form::open(['action' => ['App\Http\Controllers\ProfilesController@destroy', $profile->id], 'method'=>'POST', 'class'=>'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!} --}}
                                @endif
                            @endif
                        @endif
                    {{-- </p> --}}

                </div>
            </div>
        </div>


@endsection
