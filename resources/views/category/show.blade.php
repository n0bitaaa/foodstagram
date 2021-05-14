@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('categories.index') }}" class="btn btn-primary">Go Back</a><br><br>
        <b>ID : {{ $categories->id }}</b><br>
        <b>Name : {{ $categories->name }}</b><br>
        <b>Food_code : {{ $categories->code}}</b><br>
        <b>User_id : {{ $categories->user_id }}</b>
@endsection