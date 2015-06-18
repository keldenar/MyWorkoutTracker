@extends('home')

@section('content')
    This is the main test page for a get request.
    <br>
    {!! link_to('/test/test/1', $title = null, $attributes = array(), $secure = null) !!}
@endsection

