@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('deliverymens.index') }}" class="btn btn-primary">Go Back</a><br><br>
        <b>ID : {{ $deliverymen->id }}</b><br>
        <b>Name : {{ $deliverymen->name }}</b><br>
        <b>Phone : {{ $deliverymen->phone }}</b><br>
        <b>Email : {{ $deliverymen->email}}</b><br>
        <b>Available : {{ $deliverymen->available }}</b><br>
        <b>User_id : {{ $deliverymen->user_id }}</b>
@endsection