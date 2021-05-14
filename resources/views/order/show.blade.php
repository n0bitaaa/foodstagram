@extends('layouts.dashboard');
@section('badge')
<span class="badge bg-warning">{{$order_0}}</span>
@endsection
@section('content')
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <p>
        @foreach($orders as $key=>$order)
            @if($key==0)
                Location - {{$order->current_location}} <br>
                @if($order->state==2)
                    Cancelled By - {{ $order->user->name }}<br>
                @elseif($order->state==0)
    
                @else
                    Accepted By - {{ $order->user->name }}<br>
                @endif
                Time - {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }}
            @endif
        @endforeach
    </p>
        <table class="table table-striped text-center">
                    <thead class="bg-dark">
                        <tr>
                            <td>Order_id</td>
                            <td>Food</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Total</td>
                            <td>Remark</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key=>$order)
                            @foreach($order->foods as $key=>$food)
                                <tr>
                                    @if($key==0)
                                        <td>{{$order->id}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $food->food_name }}</td>
                                    <td>{{ $food->pivot->qty }}</td>
                                    <td>{{ $food->price }} Kyats</td>
                                    <td>{{ $food->price*$food->pivot->qty }} Kyats</td>
                                    <td>{{ $food->pivot->rmk }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
@endsection