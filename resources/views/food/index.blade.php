@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('badge')
<span class="badge bg-info">{{$order_0}}</span>
@endsection
@section('title')
    Foods
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('foods.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create food</a>
    <form class="form-inline" action="/admin/search/foods" method="get">
            <input list="foods" class="form-control mr-3" name="food" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
            <datalist id="foods">
                @foreach($foods as $food)
                    <option value="{{$food->food_name}}">{{ $food->food_name }}</option>
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
                            <td>Code</td>
                            <td>Price</td>
                            <td>Ingredients</td>
                            <td>Category</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($foods as $food)
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td class="d-flex justify-content-center">
                                <div>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#foodModal-{{$food->id}}">
                                        <img src="{{ $food->image }}" width=35px height=35px style="border-radius:20px;">
                                    </a>&nbsp;&nbsp;
                                </div>
                                    <div class="modal fade" id="foodModal-{{$food->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $food->food_name }}</h5>
                                            <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                                          </div>
                                          <div class="modal-body">
                                            <img src="{{$food->image}}" alt="food_image" height="460px" width="460px">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div>
                                        {{ $food->food_name }}
                                    </div>
                                    </td>
                                <td>{{ $food->food_code }}</td>
                                <td>{{ number_format($food->price) }} Kyats</td>
                                <td>{{ $food->ingredients }}</td>
                                <td>{{ $food->category->name }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('foods.edit',$food->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>&nbsp;
                                    <form action="{{ route('foods.destroy',$food->id) }}" method="post"> 
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
                {{ $foods->links() }}
@endsection