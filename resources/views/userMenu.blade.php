<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        <li><a href="{{ url('/auth/login') }}">Login</a></li>
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name() }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                @if (! empty($menus))
                    <hr>
                    @foreach($menus as $route => $title)
                        <li><a href="{{url("$route")}}">{{$title}}</a></li>
                    @endforeach
                @endif
            </ul>
        </li>
    @endif
</ul>