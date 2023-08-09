<nav class="navbar navbar-expand-lg navbar-light bg-light col-12">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('configs.index')}}">Configs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('data-sets.index')}}">Data Sets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Models</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            {{--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
            {{--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
            @if(Auth::guest())
                <a class="btn btn-outline-primary my-2 my-sm-0" href="{{route('login')}}">Login</a>
            @else
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Logout</button>
                </form>
            @endif
        </div>
    </div>
</nav>
