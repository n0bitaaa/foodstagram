@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Edit a Orderdetail</h1><br>
    <a href="{{ route('orderfoods.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('orderfoods.update',$orderdetail->id) }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <select class="custom-select" name="food_id">
                <option selected>Choose a food</option>
                @foreach($foods as $food)
                    @if($food->id == $orderdetail->food_id)
                        <option name="food_id" value="{{ $food->id }}" selected='selected'>{{ $food->food_name }}</option>
                    @else
                        <option name="food_id" value="{{ $food->id }}">{{ $food->food_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="integer" name="qty" class="form-control" id="qty" aria-describedby="qtyHelp" placeholder="Enter a quantity" value="{{ $orderdetail->qty }}">
            @error('qty')
                <small id="qtyHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" id="price" aria-describedby="priceHelp" placeholder="Enter a price" value="{{ $orderdetail->price }}">
            @error('price')
                <small id="priceHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="rmk">Remark</label>
            <input type="text" name="rmk" class="form-control" id="rmk" aria-describedby="rmkHelp" placeholder="Enter a remark" value="{{ $orderdetail->rmk }}">
        @error('rmk')
                <small id="rmkHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <br>
        <div class="form-group">
            <select class="custom-select" name="order_id">
                <option selected>Choose an order</option>
                @foreach($orders as $order)
                    @if($order->id == $orderdetail->order_id)
                        <option name="order_id" value="{{ $order->id }}" selected='selected'>{{$order->id}}</option>
                    @else
                        <option name="order_id" value="{{ $order->id }}">{{$order->id}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection