@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Create a deliverymen</h1>
    <a href="{{ route('deliverymens.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('deliverymens.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="username" aria-describedby="nameHelp" placeholder="Enter a username" value="{{ old('name') }}">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phHelp" placeholder="Enter a phone" value="{{ old('phone') }}">
            @error('phone')
                <small id="phHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection