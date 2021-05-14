@extends('layouts.app')
@section('css')
    <style>
        @media only screen and (max-width:375px){
            #location-form{
                margin:10px auto;
            }
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($url)? ucwords($url):""}} {{ __('Register') }}</div>

                <div class="card-body">
                @isset($url)
                    <form method="POST" action='{{ url("/register") }}' enctype="multipart/form-data">
                    @else
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @endisset
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Choose your profile image</label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="image" aria-describedby="imageHelp" value="{{ old('image') }}">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>      
                        </div>
                        @isset($url)
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">
                                Location
                            </label>
                            <div class="col-md-6">
                                <textarea name="location" id="location" class="form-control @error('location') is-invalid @enderror" style="text-transform:capitalize;" rows="4" value="{{ old('location') }}" required autocomplete="off"></textarea>
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center" id="location-form">
                                <a class="btn btn-dark" id="getLocation" data-latitude="{{ $location->latitude }}" data-longitude="{{ $location->longitude }}">
                                    <i class="fas fa-map-marker-alt"></i>
                                </a>
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js_code')
    $('#getLocation').click(function(){
        alert("Just wait for a few seconds...");
        var latitude = $(this).data('latitude');
        var longitude = $(this).data('longitude');
        $.ajax({
            url:"https://revgeocode.search.hereapi.com/v1/revgeocode?at=16.775080843706974,96.15091137619714&lang=en-US&apikey=tlkLaQt9ckvAvbEaHJtKcwy2DgeMXgaK22ymSt7igUI",
            type:"GET",
            success:function(data){
                var location = data['items']['0']['title'];
                $('#location').text(location);
                $('#getLocation').addClass('disabled');
            },
            error:function(data){
                alert("falied");
            },
        })
    })
@endpush