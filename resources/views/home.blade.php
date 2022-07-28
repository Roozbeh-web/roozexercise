@extends('templates.main')

@section('content')
    <h1>Welcome Home</h1>
    @isset($msg)
        <p style="color:red">{{$msg}}</p>
    @endisset
    <form action="{{url("/users")}}">

        <label for="name">Name</label><br>
        <input type="text" name="name"><br>

        <label for="family">Family</label><br>
        <input type="text" name="family"><br>

        <label for="age">Age</label><br>
        <input type="date" name="age"><br><br>
        <button>Send</button>
    </form>
@endsection

