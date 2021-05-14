@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('foods.index') }}" class="btn btn-primary">Go Back</a><br>
        <b>ID : {{ $foods->id }}</b><br>
        <b>Food_Name : {{ $foods->food_name }}</b><br>
        <b>Food_code : {{ $foods->food_code}}</b><br>
    <img src="{{ $foods->image }}" alt=""><br>
        <b>Price : {{ $foods->price }}</b><br>
        <b>Ingredients : {{ $foods->ingredients }}</b><br>
        <b>Category_id : {{ $foods->category_id }}</b>
@endsection