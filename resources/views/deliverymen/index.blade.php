@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('badge')
<span class="badge bg-info">{{$order_0}}</span>
@endsection
@section('title')
    Deliverymen
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('deliverymens.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Deliveryman</a>
    <form class="form-inline" action="/admin/search/deliverymens" method="get">
            <input class="form-control mr-3" name="deliverymen" type="search" placeholder="Search" aria-label="Search" list="deliverymens" autocomplete="off">
            <datalist id="deliverymens">
                @foreach($deliverymens as $deliverymen)
                    <option value="{{ $deliverymen->name }}">{{ $deliverymen->name }}</option>
                @endforeach
            </datalist>
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
    @if(Session::has('available'))
        <p class="alert alert-success">{{ Session::get('available') }}</p>
    @endif
    @if(Session::has('unavailable'))
        <p class="alert alert-danger">{{ Session::get('unavailable') }}</p>
    @endif
    <table class="table table-striped text-center">
                    <thead class="bg-dark">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>User_name</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Days of Absence">D.O.A</td>
                            <td>Status</td>
                            <td>Process</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($deliverymens as $deliverymen)
                            <tr>
                                <td>{{ $deliverymen->id }}</td>
                                <td>{{ $deliverymen->name }}</td>
                                <td>{{ $deliverymen->email }}</td>
                                <td>{{ $deliverymen->phone }}</td>
                                <td>{{ $deliverymen->user->name}}</td>
                                @if($deliverymen->doa==0)
                                    <td>None</td>
                                @else
                                    <td>{{ $deliverymen->doa }} Days</td>
                                @endif
                                <td>
                                    @if($deliverymen->status==0)
                                        <h6 class="bg-info p-2 ml-2 d-inline-block" style="width:80px;">Available</h6>
                                    @else
                                        <h6 class="bg-danger p-2 d-inline-block" style="width:100px;">Unavailable</h6>
                                    @endif                                       
                                </td>
                                <td>
                                    <a href="{{ route('deliverymens.available',$deliverymen->id) }}" class="btn btn-success"><i class="far fa-thumbs-up"></i></a>
                                    <a href="{{ route('deliverymens.unavailable',$deliverymen->id) }}" class="btn btn-danger"><i class="far fa-thumbs-down"></i></a>
                                </td>
                                <td class="d-flex justify-content-center">
                                <a href="{{ route('deliverymens.edit',$deliverymen->id) }}" class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </a>&nbsp;
                                <form action="{{ route('deliverymens.destroy',$deliverymen->id) }}" method="post"> 
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
                                    <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $deliverymens->links() }}
@endsection