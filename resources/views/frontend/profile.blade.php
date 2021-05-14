@extends('frontend.template')
@section('pageTitle','Profile | Foodstagram')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
            <h3 class="top text-center mt-3 mb-2"><strong>Your Profile</strong></h3>
                <div class="card mt-5">
                    @if(Session::has('success'))
                        <p class="text-center alert alert-success">{{ Session::get('success') }}</p>
                    @elseif(Session::has('success_pwd'))
                        <p class="text-center alert alert-success">{{ Session::get('success_pwd') }}</p>
                    @elseif(Session::has('fail_pwd'))
                        <p class="text-center alert alert-danger">{{ Session::get('fail_pwd') }}</p>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xxl-12 col-xl-12 col-12" id="profile-image">
                                <form action="{{ route('picUpdate',Auth::guard('customer')->id()) }}" method="post" class="d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                    <div>
                                        <h5 class="text-center text-muted my-2"><strong>Profile Picture</strong></h5>
                                        <img src="{{ Auth::guard('customer')->user()->image }}" alt="profile-image" class="rounded-circle"> 
                                        <div class="text-center">
                                            <input type="file" name="image" class="form-control-file" accept="image/*" id="image" hidden>
                                            <label for="image">Choose File</label>
                                            <p id="file-chosen" class="mt-2" style="font-size:14px;">No file chosen</p>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary disabled saveImage" style="float:right;" onclick="return confirm('Are you sure to update?')">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!--col-12-->
                            <hr>
                            <div class="col-xxl-12 text-center" id="information-col">
                                <div>
                                    <div>
                                        <h5 class="text-muted mt-3" style="font-family:sans-serif;letter-spacing:1px;"><strong>Information</strong></h5>
                                    </div>
                                    <form action="{{ route('detailUpdate',Auth::guard('customer')->user()->id) }}" id="information" method="post">
                                        @csrf
                                        <div class="row d-flex justify-content-between">
                                            <div class="col-xxl-6 col-xl-12">
                                                <label for="username" class="form-label">Name</label>
                                                <input type="text" class="form-control text-center" name="name" aria-describedby="nameHelp" value="{{ Auth::guard('customer')->user()->name }}" id="username" autocomplete=off placeholder="Your name">
                                                @error('name')
                                                    <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-xxl-6 col-xl-12">
                                                <label for="phone" class="form-label">Phone number</label>
                                                <input type="number" class="form-control text-center" name="phone" aria-describedby="phoneHelp" value="{{ Auth::guard('customer')->user()->phone }}" id="phone" autocomplete=off placeholder="Your phone">
                                                @error('phone')
                                                    <small id="phoneHelp" class="form-text text-danger text-center">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div><!--div-->
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-xxl-12 col-xl-12">
                                                <label for="location" class="form-label">Default Location</label>
                                                <textarea class="form-control text-center" name="location" aria-describedby="loHelp"  id="location" autocomplete=off rows="3">{{ Auth::guard('customer')->user()->location }}</textarea>
                                                @error('location')
                                                    <small id="loHelp" class="form-text text-danger text-center">{{ $message }}</small>
                                                @enderror
                                                <button class="btn btn-primary mt-4 disabled" type="submit" style="float:right;" onclick="return confirm('Are you sure to update?')">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="my-4">
                                    <div>
                                        <h5 class="text-center text-muted my-4" style="font-family: sans-serif;letter-spacing:1px;"><strong>Password</strong></h5>
                                    </div>
                                    <form action="{{ route('passUpdate',Auth::guard('customer')->user()->id) }}" method="post" id="password">
                                        @csrf
                                            <div class="row">
                                                <label for="cpassword" class="col-xxl-6 col-xl-6 col-12 col-form-label">Current Password</label>
                                                <div class="col-xxl-6 col-xl-6 col-12">
                                                    <input type="password" class="form-control" name="cpassword" aria-describedby="cpwHelp" id="cpassword" autocomplete=off placeholder="Your current passowrd">
                                                    @error('cpassword')
                                                        <small id="cpwHelp" class="form-text text-danger">Current password cant be empty.</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label for="password" class="col-xxl-6 col-xl-6 col-12 col-form-label">New Password</label>
                                                <div class="col-xxl-6 col-xl-6 col-12">
                                                    <input type="password" class="form-control" name="password" aria-describedby="pwHelp"  id="password" autocomplete=off placeholder="Your new passowrd">
                                                    @error('password')
                                                        <small id="pwHelp" class="form-text text-danger">{{$message}}</small>
                                                    @enderror
                                                    <button class="btn btn-primary disabled mt-4" type="submit" style="float:right;" onclick="return confirm('Are you sure to update?')">Save</button>
                                                </div>
                                            </div>
                                    </form>
                                </div><!--password-->
                            </div><!--col-8-->
                        </div><!--row-->
                    </div><!--card-body-->
                </div><!--card-->
            </div><!--col-12-->
        </div><!--row-->
    </div><!--container-->
@endsection
@push('js')
    <script src="{{ asset('js/frontend/profile.js') }}"></script>
@endpush
@push('functions')
    setTimeout(function(){
   $("p.alert,small.form-text").remove();
}, 4000 );
@endpush