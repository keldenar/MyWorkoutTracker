@extends('home')

@section('content')
    This is the main test page for a get request with an id.
    <br>
    {!! link_to('/test/1', $title = null, $attributes = array(), $secure = null) !!}
@endsection

