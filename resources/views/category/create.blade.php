@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Create a category</h1><br>
    <a href="{{ route('categories.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter a food name" value="{{ old('name') }}">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="code">Category Code</label>
            <input type="text" name="code" class="form-control" id="code" aria-describedby="codeHelp" placeholder="Enter a food code" value="{{ old('code') }}">
            @error('code')
                <small id="codeHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection