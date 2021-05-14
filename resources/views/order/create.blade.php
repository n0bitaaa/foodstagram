@extends('layouts.dashboard')
@section('content')
    <br>
    <h1>Create a order</h1><br>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Go Back</a><br><br>
    @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        <table class="table" id="foods_table">
            <tr>
                <td><label for="code">Code</label></td>
                <td></td>
                <td>
                @if(Session::has('code'))
                <p>{{ Session::get('code') }}</p>
                @else
                <p>--------</p>
                @endif
                </td>
            </tr>
            <tr>
                <td><label for="current_location">Current Location</label></td>
                <td></td>
                <td>
                <input type="text" name="current_location" class="form-control" id="current_location" aria-describedby="locationHelp" placeholder="No.(xxx) xx floor xx Street xx Township" value="{{ old('current_location') }}">
                @error('current_location')
                    <small id="locationHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
                </td>
            </tr>
            <!-- <tr>
                <td><label for="rmk">Remark</label></td>
                <td>
                <input type="text" name="rmks" class="form-control" id="rmk" aria-describedby="rmkHelp" placeholder="Enter a remark" value="{{ old('rmk') }}">
                @error('rmk')
                    <small id="rmkHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
                </td>
            </tr> -->
            <tr id="food0">
                <td>
                    <select name="foods[]" class="form-control">
                        <option value="">Choose a food</option>
                            @foreach ($foods as $food)
                                <option value="{{ $food->id }}">
                                    {{ $food->food_name }} ({{ number_format($food->price, 2) }} Kyats)
                                </option>
                            @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="quantities[]" class="form-control" value="1" />
                </td>
                <td>
                    <input type="text" name="remarks[]" class="form-control" placeholder="Remark" />
                </td>
            </tr>
            <tr id="food1"></tr>
        </table>
        <div class="row">
                <div class="col-md-12">
                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
        </div><br>
        <button type="submit" class="btn btn-success">Submit</button>
        
    </form>
@endsection