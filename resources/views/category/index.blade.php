@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('title')
    Categories
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Category</a>
    <form class="form-inline" action="/admin/search/categories" method="get">
            <input class="form-control mr-3" name="category" type="search" placeholder="Search" aria-label="Search" list="categories" autocomplete="off">
            <datalist id="categories">
                @foreach($categories as $category)
                    <option value="{{$category->name}}">{{ $category->name }}</option>
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
                            <td>Created by</td>
                            <td>User_id</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->code }}</td>
                                <td>
                                   <span class="text-center">{{ $category->user->name }}</span>
                                </td>
                                <td>{{ $category->user_id }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </a>&nbsp;&nbsp;
                                    <form action="{{ route('categories.destroy',$category->id) }}" method="post"> 
                                    @method('delete')
                                    @csrf 
                                    <button onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger"> <i class="far fa-trash-alt"></i></button>
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
                           </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->links() }}
@endsection