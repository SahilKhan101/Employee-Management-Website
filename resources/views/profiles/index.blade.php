@extends('layouts.app')

@section('content')


<div class="row">
<div class="col-md-3">
</div>

@if(count($profiles)>0)
    @foreach($profiles as $profile)

        <div class="col-md-3">
            <div class="card mt-5" style="width: 18rem;">
                {{-- <img class="card-img-top" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="Card image cap" width="200px "> --}}
                <img class="card-img-top" src="/storage/cover_images/{{$profile->cover_image}}" alt="Card image cap" width="200px ">
                
                <ul class="list-group list-group-flush">
                <li class="list-group-item bg-dark text-white">Username - {{$profile->user->name ?? 'N/A'}}</li>
                <li class="list-group-item bg-dark text-white">Phone - {{$profile->phone ?? 'N/A'}}</li>
                <li class="list-group-item bg-dark text-white">Gender - {{$profile->gender ?? 'N/A'}}</li>
                <li class="list-group-item bg-dark text-white">Age - {{$profile->age ?? 'N/A'}}</li>
                <li class="list-group-item bg-dark text-white">Company - {{$profile->company ?? 'N/A'}}</li>
                <li class="list-group-item bg-dark text-white">Address - {{$profile->address ?? 'N/A'}}</li>
                </ul>
                
            </div>

            
        </div>
    
    @endforeach
@else
    <p>Update Profile</p>
@endif
     
<div class="col-md-3 mt-5">
    <h1>Edit Details</h1>
    <form method="POST" enctype="multipart/form-data">
        <input class="btn btn-primary" type="submit" value="submit">
    </form>
</div>
<div class="col-md-3"></div>
</div>

@endsection
