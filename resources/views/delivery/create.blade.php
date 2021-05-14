@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Create a delivery</h1><br>
    <a href="{{ route('deliveries.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('deliveries.store') }}" method="post">
        @csrf
            <div class="form-group">
            <select class="custom-select" name="order_id">
            <option selected>Choose an order</option>
            @foreach($orders as $order)
                <option name="order_id" value="{{ $order->id }}">{{$order->id}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <select class="custom-select" name="delivery_men_id">
            <option selected>Choose a deliverymen</option>
                @foreach($deliverymens as $deliverymen)
                <option name="delivery_men_id" value="{{ $deliverymen->id }}">{{$deliverymen->name}}</option>
                @endforeach
            </select>
            </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection