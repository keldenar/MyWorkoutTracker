@extends('app')

@section('content')
<div class="container col-md-12">
    @include('adsense')
	<div class="row">
        <div class="col-md-offset-2 col-md-8">
            @section('display')
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            @show
        </div>

	</div>
</div>
@endsection
