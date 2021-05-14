@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('deliveries.index') }}" class="btn btn-primary">Go Back</a><br><br>
        <b>ID : {{ $delivery->id }}</b><br>
        <b>User_id : {{ $delivery->user_id }}</b><br>
        <b>delivery_men_id : {{ $delivery->delivery_men_id}}</b><br>
        <b>Order_id : {{ $delivery->order_id }}</b>
@endsection