@extends('templates.main')

@section('content')
    <h1>Welcome {{$name}}</h1>
    <p>Your age: {{$age}}</p>
    <a href="{{route("show", ["key"=>1])}}">Laravel document (see)</a><br>
    <a href="{{route("download", ["key"=>1])}}">Laravel document (download)</a>
@endsection