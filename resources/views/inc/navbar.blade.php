<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: #27ae60 1px solid;">
  {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: #FFFFFF 1px solid;"> --}}

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 600px;">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link text-secondary" href="{{route('e-dashboard')}}">Dashboard</span></a>
        </li>
        <li class="nav-item">
          @if(Auth::user()->profiles ?? Null)
            <a class="nav-link text-secondary" href="/profiles/{{Auth::user()->profiles->id ?? 'None'}}">My Profile</a>
          @else
            <a class="nav-link text-secondary" href="{{route('create-profile')}}">My Profile</a>
          @endif
        </li>
        

        @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest

      </ul>



    </div>
  </nav>
