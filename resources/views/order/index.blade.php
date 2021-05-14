@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="10" />
@endsection
@section('badge')
<span class="badge bg-warning">{{$order_0}}</span>
@endsection
@section('title')
    Orders
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('orders.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Order</a>
    <form class="form-inline" action="/admin/search/orders" method="get">
            <input class="form-control mr-3" name="order" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    </nav>
    <br>
    @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif
    @if(Session::has('delete'))
        <p class="alert alert-danger">{{ Session::get('delete') }}</p>
    @endif
    @if(Session::has('edit'))
        <p class="alert alert-info">{{ Session::get('edit') }}</p>
    @endif
    @if(Session::has('accept'))
        <p class="alert alert-info">{{ Session::get('accept') }}</p>
    @endif
    @if(Session::has('decline'))
        <p class="alert alert-danger">{{ Session::get('decline') }}</p>
    @endif
    <table class="table table-striped text-center">
                    <thead class="bg-dark">
                        <tr>
                            <td>ID</td>
                            <td>Order_code</td>
                            <td>Total Quantity</td>
                            <td>Total Price</td>
                            <td>Customer</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Status</td>
                            <td>Process</td>
                            <td>Actions</td>
                                                    
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->tot_qty }}</td>
                                <td>{{ number_format($order->totl_amt) }} Kyats</td>
                                <td>
                                    {{ $order->customer->name }}
                                </td>
                                <td>
                                @if($order->state==0)
                                    <h6 class="bg-info p-2 d-inline-block" style="width:80px;">Pending..</h6>
							    @elseif($order->state==1)
                                    <h6 class="bg-secondary p-2 d-inline-block" style="width:80px;">Accepted</h6>
                                @elseif($order->state==2)
                                    <h6 class="bg-danger p-2 d-inline-block" style="width:80px;">Declined</h6>
                                @elseif($order->state==3)
                                    <h6 class="bg-warning p-2 d-inline-block" style="width:83px;">Delivering</h6>
                                @else
                                    <h6 class="bg-dark p-2 d-inline-block" style="width:80px;">Delivered</h6>
							    @endif
                                </td>
                                <td>
                                @if($order->state==0)
                                <a href="{{ route('orders.active',$order->id) }}" onclick="return confirm('Are you sure to accept order({{$order->id}})?')" class="btn btn-success">Accept</a>
                                <a href="{{ route('orders.decline',$order->id) }}" onclick="return confirm('Are you sure to decline order({{$order->id}})?')"class="btn btn-danger">Decline</a>
                                @endif
                                </td>
                                <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('orders.show',$order->id) }}" class="btn btn-success">
                                        <i class="far fa-eye"></i>
                                    </a>&nbsp;&nbsp;
                                    <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>&nbsp;&nbsp;
                                    <form action="{{ route('orders.destroy',$order->id) }}" method="post"> 
                                        @method('delete')
                                        @csrf 
                                            <button onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><h1>Unavailable Data TvT</h1></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                           </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}
@endsection