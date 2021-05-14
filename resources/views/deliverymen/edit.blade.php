@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Edit a deliverymen</h1><br>
    <a href="{{ route('deliverymens.index') }}" class="btn btn-primary">Go Back</a><br><br>
    <form action="{{ route('deliverymens.update',$deliverymen->id) }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Deliverymen Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter a deliverymen name" value="{{ $deliverymen->name }}">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phHelp" placeholder="Enter a phone" value="{{ $deliverymen->phone }}">
            @error('phone')
                <small id="phHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter a email" value="{{ $deliverymen->email }}">
            @error('email')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="doa">Days of Absence</label>
            <input type="text" name="doa" class="form-control" id="doa" aria-describedby="doaHelp" value="{{ $deliverymen->doa }}">
            @error('phone')
                <small id="doaHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection