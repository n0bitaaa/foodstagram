@extends('layouts.dashboard');
@section('content')
    <a href="{{ route('customers.index') }}" class="btn btn-primary">Go Back</a><br>
        <b>ID : {{ $customer->id }}</b><br>
        <b>Name : {{ $customer->name }}</b><br>
        <b>Phone : {{ $customer->phone}}</b><br>
        <b>Email : {{ $customer->email }}</b><br>
        <b>Password : {{ $customer->password }}</b><br>
@endsection