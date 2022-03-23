@extends('layouts.app')

@section('content')

    {{-- <div class="col-md-3">
        <div class="card mt-5" style="width: 18rem;">
            <img class="card-img-top" src="/storage/cover_images/noimage.jpg" alt="Card image cap" width="200px ">
            
            <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark text-white">Username - {{Auth::user()->name ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Phone - {{$profile->phone ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Gender - {{$profile->gender  ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Age - {{$profile->age ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Company - {{$profile->company ?? 'N/A'}}</li>
            <li class="list-group-item bg-dark text-white">Address - {{$profile->address ?? 'N/A'}}</li>
            </ul>
            
        </div>

        
    </div>

    @if(!Auth::guest())
        @if(!Auth::user()->profiles)
            <a href="/profiles/create" class="btn btn-outline-secondary">Update information</a>
        @else
            @if(Auth::user()->id == ($profile->user_id ?? 'N/A'))
                <a href="/profiles/{{$profile->id}}/edit" class="btn btn-outline-secondary">Edit</a>

            @endif
        @endif
    @endif --}}

    <div class="blogs" style="margin-top:0 !important; margin:0 auto; font-size:13px; color:#FFFFFF !important; ">
        <div class="blog">
            <img src="/storage/cover_images/noimage.jpg" style="width: 100%" alt="">
            <div class="blog-text center justify-content-center">
                <h4 class="center justify-content-center" style="align:center;">
                    {{$profile->user->name ?? 'N/A'}}
                </h4>
                {{-- <p> --}}
                    <ul class="list-group list-group-flush">
                        {{-- <li class="list-group-item bg-dark text-white">Username - {{Auth::user()->name ?? 'N/A'}}</li> --}}
                        {{-- <li class="list-group-item bg-dark text-white">Username - {{$profile->user->name ?? 'N/A'}}</li> --}}
                        <li class="list-group-item bg-dark text-white"><span>Phone</span>  - <span class="">{{$profile->phone ?? 'N/A'}}</span></li>
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
                                <a href="/profiles/{{$profile->id}}/edit" class="btn btn-secondary">Edit</a>
                            @endif
                        @endif
                    @endif
                {{-- </p> --}}

            </div>
        </div>
    </div>
@endsection
