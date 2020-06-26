<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Client Facing Website') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav m-auto">
                <form action="{{ url('search') }}" method="post">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 400px;">
                        <input type="text" class="form-control" name="search" placeholder="Search by title, body, section, and tags">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">Search</button>
                        </span>
                    </div>
                </form>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(!Auth::guard('client')->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('client-login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @foreach(\App\Section::get() as $value)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('section.wise.story', $value->id) }}">{{ $value->title }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a  class="nav-link" href="{{ route('client.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        @if(Auth::guard('client')->user()->avatar)
                            <img style="width: 30px; height: 30px; float: left;" src="{{ url('storage/client/', Auth::guard('client')->user()->avatar) }}"
                                class="img-circle img-fluid">
                        @else
                            <img style="width: 30px; height: 30px; float: left; padding-top: 5px;"
                                 src="{{ url('storage/client/avatar04.png') }}"
                                 class="img-circle img-fluid" alt="">
                        @endif
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ explode(" ",Auth::guard('client')->user()->name)[0]  }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
