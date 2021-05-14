@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a><br><br>
        <b>ID : {{ $users->id }}</b><br>
        <b>Name : {{ $users->name }}</b><br>
        <b>Email : {{ $users->email}}</b><br>
        <b>Phone : {{ $users->phone }}</b><br>
        <b>Image : </b><br>
        <img src="{{ $users->image }}" alt="">
    </div>
@endsection