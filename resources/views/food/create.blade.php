@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Create a food</h1><br>
    <a href="{{ route('foods.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('foods.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="food_name">Food Name</label>
            <input type="text" name="food_name" class="form-control" id="food_name" aria-describedby="nameHelp" placeholder="Enter a food name" value="{{ old('food_name') }}">
            @error('food_name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="food_code">Food Code</label>
            <input type="text" name="food_code" class="form-control" id="food_code" aria-describedby="codeHelp" placeholder="Enter a food code" value="{{ old('food_code') }}">
            @error('food_code')
                <small id="codeHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Choose your food image</label>
            <input type="file" name="image" class="form-control-file" id="image" aria-describedby="imageHelp" value="{{ old('image') }}">
            @error('image')
                <small id="imageHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Food Price</label>
            <div class="input-group">
                <input type="text" name="price" class="form-control" id="price" aria-describedby="priceHelp" placeholder="Enter a food price" value="{{ old('price') }}">
                <span class="input-group-text">Kyats</span>
            </div>
            @error('price')
                <small id="priceHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ingredients">Enter the ingredients</label>
            <textarea class="form-control" name="ingredients" id="ingredients" rows="5" placeholder="Enter the ingredients" aria-describedby="desHelp">{{ old('ingredients') }}</textarea>
            @error('ingredients')
                <small id="desHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
            <select class="custom-select" name="category_id">
                @foreach($categories as $category)
                <option name="category_id" value="{{ $category->id }}">{{$category->name}}</option>
                @endforeach
            </select>
            <br><br>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection