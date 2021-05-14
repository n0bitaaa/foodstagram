@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Edit a order</h1><br>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('orders.update',$order->id) }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" class="form-control" id="code" aria-describedby="codeHelp" placeholder="Enter a order code" value="{{ $order->code }}">
            @error('code')
                <small id="codeHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="current_location">Current Location</label>
            <input type="text" name="current_location" class="form-control" id="current_location" aria-describedby="locationHelp" placeholder="Enter a location" value="{{ $order->current_location }}">
            @error('current_location')
                <small id="locationHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="tot_qty">Total Quantity</label>
            <input type="text" name="tot_qty" class="form-control" id="tot_qty" aria-describedby="qtyHelp" placeholder="Enter a total quantity" value="{{ $order->tot_qty }}">
            @error('tot_qty')
                <small id="qtyHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="totl_amt">Total Amount</label>
            <input type="text" name="totl_amt" class="form-control" id="totl_amt" aria-describedby="amtHelp" placeholder="Enter a total amount" value="{{ $order->totl_amt }}">
            @error('totl_amt')
                <small id="amtHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection