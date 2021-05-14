@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Edit a food</h1><br>
    <a href="{{ route('foods.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('foods.update',$food->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="food_name">Food Name</label>
            <input type="text" name="food_name" class="form-control" id="food_name" aria-describedby="nameHelp" placeholder="Enter a food name" value="{{ $food->food_name }}">
            @error('food_name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="food_code">Food Code</label>
            <input type="text" name="food_code" class="form-control" id="food_code" aria-describedby="codeHelp" placeholder="Enter a food code" value="{{ $food->food_code }}">
            @error('food_code')
                <small id="codeHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        
        
        <div class="form-group">
            <label for="image">Choose your food image</label>
            <input type="file" name="image" class="form-control-file" id="image" aria-describedby="imageHelp" value="{{ $food->image }}">
            @error('image')
                <small id="imageHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        @isset( $food->image )
            <div class="form-group">
                <label for="image">Images</label>
                <img src="{{ $food->image }}" style="height:100px;width:100px;">
            </div>
        @endif
        
        
        <div class="form-group">
            <label for="price">Food Price</label>
            <input type="text" name="price" class="form-control" id="price" aria-describedby="priceHelp" placeholder="Enter a food price" value="{{ $food->price }}">
            @error('price')
                <small id="priceHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="ingredients">Enter the ingredients</label>
            <textarea class="form-control" name="ingredients" id="ingredients" rows="5" placeholder="Enter the ingredients" aria-describedby="desHelp">{{ $food->ingredients }}</textarea>
            @error('ingredients')
                <small id="desHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
            <select class="custom-select" name="category_id">
                @foreach($categories as $category)
                    <!-- <option name="category_id" value="{{ $food->category_id }}">{{ $category->name }}</option> -->
                    @if($category->id==$food->category_id) 
                        <option name="category_id" value="{{$category->id}}" selected='selected'>{{$category->name}}</option>
                    @else
                        <option name="category_id" value="{{$category->id}}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
            <br><br>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection