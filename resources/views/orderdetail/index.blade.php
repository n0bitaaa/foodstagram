@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('title')
    Order-details
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('orderfoods.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Cant Create Orderdetail</a>
    <form class="form-inline" action="/admin/search/orderdetails" method="get">
            <input class="form-control mr-3" name="orderdetail" type="search" placeholder="Search" aria-label="Search">
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
    <table class="table table-striped">
                    <thead class="bg-dark">
                        <tr>
                            <td>ID</td>
                            <td>Order_id</td>
                            <td>&nbsp;&nbsp;&nbsp;Food</td>
                            <td>Quantity</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price</td>
                            <td class="pl-5">Remark</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderdetails as $orderdetail)
                            <tr>
                                <td>{{ $orderdetail->id }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $orderdetail->order_id }}</td>
                                <td>
                                    @foreach($foods as $food)
                                        @if($food->id == $orderdetail->food_id)
                                            {{ $food->food_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="pl-4">{{ $orderdetail->qty }}</td>
                                <td>{{ $orderdetail->price * $orderdetail->qty }} Kyats</td>
                                <td>{{ $orderdetail->rmk }}</td>
                                <td style="display:flex;">
                                    <a href="{{ route('orderfoods.edit',$orderdetail->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>&nbsp;&nbsp;
                                    <form action="{{ route('orderfoods.destroy',$orderdetail->id) }}" method="post"> 
                                        @method('delete')
                                        @csrf 
                                        <button onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger"> <i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orderdetails->links() }}
@endsection