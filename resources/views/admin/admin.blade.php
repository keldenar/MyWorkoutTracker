@extends("app")

@section("content")
    <div class="container col-md-12">
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Administration</div>
                    <div class="panel-body">
                        <!-- TODO: This section needs to get automated -->
                        @foreach($menus as $route => $title)
                        <div>
                            <a href="{{ url($route) }}">{{ $title }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-md-offset-1">
            @yield("adminContent")
            </div>
        </div>
    </div>
@endsection
