@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('badge')
<span class="badge bg-info">{{$order_0}}</span>
@endsection
@section('title')
    Customers
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('customers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Customer</a>
    <form class="form-inline" action="/admin/search/customers" method="get">
            <input class="form-control mr-3" name="customer" type="search" placeholder="Search" aria-label="Search" list="customers" autocomplete="off">
            <datalist id="customers">
                @foreach($customers as $customer)
                    <option value="{{ $customer->name }}">{{ $customer->name }}</option>
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
    <table class="table table-striped text-center">
                    <thead class="bg-dark">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Verification</td>
                            <td>Location</td>
                            <td>Status</td>
                            <td>Phone</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @if($customer->email_verified_at)
                                        <button class="btn btn-success" onclick="alert('This email was verified.')">Verified</button>
                                    @else
                                        <button class="btn btn-danger" onclick="alert('This email has not been verified yet.')">Unverified</button>
                                    @endif
                                </td>
                                <td style="text-transform:capitalize;">{{ $customer->location }}</td>
                                <td>
                                    @if($customer->isOnline())
                                        <li class="text-success">Online</li>
                                    @else
                                        <li class="text-muted">Offline</li>
                                    @endif
                                </td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                <form action="{{ route('customers.destroy',$customer->id) }}" method="post"> 
                                    @method('delete')
                                    @csrf 
                                    <button onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
                           </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $customers->links() }}
@endsection