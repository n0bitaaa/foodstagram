@extends('layouts.dashboard')
@section('content')
    <h1>Edit a category</h1><br>
    <a href="{{ route('categories.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('categories.update',$category->id) }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Food Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter a food name" value="{{ $category->name }}">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="code">Food Code</label>
            <input type="text" name="code" class="form-control" id="code" aria-describedby="codeHelp" placeholder="Enter a food code" value="{{ $category->code }}">
            @error('code')
                <small id="codeHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection