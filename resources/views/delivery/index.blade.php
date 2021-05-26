@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('title')
    Deliveries
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('deliveries.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Delivery</a>
    <form class="form-inline" action="/admin/search/deliveries" method="get">
            <input class="form-control mr-3" name="delivery" type="search" placeholder="Search" aria-label="Search">
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
    @if(Session::has('finish'))
        <p class="alert alert-success">{{ Session::get('finish') }}</p>
    @endif
    <table class="table table-striped text-center">
                    <thead class="bg-dark">
                        <tr>
                            <td>ID</td>
                            <td>Order</td>
                            <td class="pl-4">Customer</td>
                            <td>Deliveryman</td>
                            <td class="pl-4">User</td>
                            <td>Status</td>
                            <td>Process</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->id }}</td>
                                <td>{{ $delivery->order_id}}</td>
                                <td>
                                    @foreach($orders as $order)
                                        @if($order->id==$delivery->order_id)
                                            {{ $order->customer->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $delivery->delivery_men->name }}
                                </td>
                                <td>
                                   {{ $delivery->user->name }}
                                </td>
                                <td>
                                    @if($delivery->status==0)
                                        <h6 class="bg-secondary p-2 d-inline-block" style="width:85px;">Delivering</h6>
                                    @else
                                        <h6 class="bg-dark p-2 d-inline-block" style="width:80px;">Finished</h6>
                                    @endif
                                </td>
                                <td>
                                @if($delivery->status==0)
                                    <a href="{{route('deliveries.finish',$delivery->id)}}" onclick="return confirm('Is this order really finished?')" class="btn btn-info">Finish</a>
                                @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('deliveries.edit',$delivery->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>&nbsp;&nbsp;
                                <form action="{{ route('deliveries.destroy',$delivery->id) }}" method="post"> 
                                    @method('delete')
                                    @csrf 
                                    <button onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger"> <i class="far fa-trash-alt"></i></button>
                                </form>
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
                {{ $deliveries->links() }}
@endsection