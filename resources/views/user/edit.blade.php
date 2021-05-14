@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Edit user</h1>
    <a href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="name" class="form-control" id="username" aria-describedby="nameHelp" value="{{ $user->name }}">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="pwd">Password (If you dont want to change,dont fill anything.just leave a blank.)</label>
            <input type="password" name="password" class="form-control" id="pwd" aria-describedby="pwdHelp" placeholder="Enter a password">
            @error('password')
                <small id="pwdHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" value="{{ $user->email }}">
            @error('email')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phHelp" placeholder="Enter a phone" value="{{ $user->phone }}">
            @error('phone')
                <small id="phHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Choose your food image</label>
            <input type="file" name="image" class="form-control-file" id="image" aria-describedby="imageHelp" value="{{ $user->image }}">
            @error('image')
                <small id="imageHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        @isset( $user->image )
            <div class="form-group">
                <label for="image">Images</label>
                <img src="{{ $user->image }}" style="height:100px;width:100px;">
            </div>
        @endif
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection