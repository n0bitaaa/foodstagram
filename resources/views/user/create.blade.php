@extends('layouts.dashboard')

@section('content')
    <h1>Create user</h1><br>
    <a href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="name" class="form-control" id="username" aria-describedby="nameHelp" value="{{ old('name') }}" placeholder="Enter a username">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">E-mail Address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" name="password" class="form-control" id="pwd" aria-describedby="pwdHelp" placeholder="Enter a password" value="{{ old('password') }}">
            @error('password')
                <small id="pwdHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm">Password Confirmation</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype the password again">
        </div>
        <div class="form-group">
            <label for="image">Choose your profile image</label>
            <input type="file" name="image" class="form-control" id="image" aria-describedby="imageHelp" value="{{ old('image') }}">
            @error('image')
                <small id="imageHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phHelp" placeholder="Enter a phone" value="{{ old('phone') }}">
            @error('phone')
                <small id="phHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div><br>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
