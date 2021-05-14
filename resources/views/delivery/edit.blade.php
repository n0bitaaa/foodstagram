@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Edit a delivery</h1><br>
    <a href="{{ route('deliveries.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('deliveries.update',$delivery->id) }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
            <select class="custom-select" name="order_id">
            <option selected>Choose a order</option>
            @foreach($orders as $order)
                @if($order->id == $delivery->order_id)
                    <option name="order_id" value="{{ $order->id }}" selected='selected'>{{$order->code}}</option>
                @else
                <option name="order_id" value="{{ $order->id }}">{{$order->code}}</option>
                @endif
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <select class="custom-select" name="delivery_men_id">
            <option selected>Choose a deliverymen</option>
                @foreach($deliverymens as $deliverymen)
                    @if($deliverymen->id == $delivery->delivery_men_id)
                        <option name="delivery_men_id" value="{{ $deliverymen->id }}" selected='selected'>{{$deliverymen->name}}</option>
                    @else
                    <option name="delivery_men_id" value="{{ $deliverymen->id }}">{{$deliverymen->name}}</option>
                    @endif
                @endforeach
            </select>
            </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection