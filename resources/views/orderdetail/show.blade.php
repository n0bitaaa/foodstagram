@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('orderfoods.index') }}" class="btn btn-primary">Go Back</a><br><br>
        <b>ID : {{ $orderdetail->id }}</b><br>
        <b>Food_Id : {{ $orderdetail->food_id }}</b><br>
        <b>Quantity : {{ $orderdetail->qty}}</b><br>
        <b>Price : {{ $orderdetail->price }}</b><br>
        <b>Remark : {{ $orderdetail->rmk }}</b><br>
        <b>Order_id : {{ $orderdetail->order_id }}</b><br>
@endsection