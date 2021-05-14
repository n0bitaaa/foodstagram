@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Create a Orderdetail</h1><br>
    <a href="{{ route('orderfoods.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('orderfoods.store') }}" method="post">
        @csrf
        <div class="form-group">
            <select class="custom-select" name="food_id">
                <option selected>Choose a food</option>
                @foreach($foods as $food)
                    <option name="food_id" value="{{ $food->id }}" aria-describedBy="idHelp">{{ $food->food_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="integer" name="qty" class="form-control" id="qty" aria-describedby="qtyHelp" placeholder="Enter a quantity" value="{{ old('qty') }}">
            @error('qty')
                <small id="qtyHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="rmk">Remark</label>
            <input type="text" name="rmk" class="form-control" id="rmk" aria-describedby="rmkHelp" placeholder="Enter a remark" value="{{ old('rmk') }}">
        @error('rmk')
                <small id="rmkHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <br>
        <div class="form-group">
            <select class="custom-select" name="order_id">
                <option selected>Choose an order</option>
                @foreach($orders as $order)
                    <option name="order_id" value="{{ $order->id }}">{{$order->id}}</option>
                @endforeach
            </select>
        </div><br>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection