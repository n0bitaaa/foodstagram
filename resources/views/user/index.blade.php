@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="708" />
@endsection
@section('title')
    Users
@endsection
@section('content')
    <nav class="navbar">
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create User</a>
        <form class="form-inline" action="/admin/search/users" method="get">
            <input class="form-control mr-3" name="user" type="search" placeholder="Search" aria-label="Search" list="users" autocomplete="off">
            <datalist id="users">
                @foreach($users as $user)
                    <option value="{{$user->name}}">{{ $user->name }}</option>
                @endforeach
            </datalist>
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav><br>
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
                                <td>Email</td>
                                <td>Status</td>
                                <td>Phone</td>
                                <td>Created_at</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#userModal-{{$user->id}}">
                                            <img src="{{ $user->image }}" width="35" height="35" style="border-radius:20px;">&nbsp;&nbsp;&nbsp;
                                        </a>
                                        <div class="modal fade" id="userModal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{$user->image}}" alt="food_image" height="460px" width="460px">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>    
                                        {{ $user->name }}    
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->isOnline())
                                            <li class="text-success">Online</li>
                                        @else
                                            <li class="text-muted">Offline</li>
                                        @endif
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="d-flex justify-content-center">
                                    @if(Auth::user()->id==$user->id)
                                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>&nbsp;
                                        <form action="{{ route('users.destroy',$user->id) }}" method="post"> 
                                            @method('delete')
                                            @csrf 
                                            <button onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    @else
                                        <p>&nbsp;</p>
                                    @endif
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
                {{ $users->links() }}
@endsection
