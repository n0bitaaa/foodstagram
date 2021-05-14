@extends('frontend.template')
@section('pageTitle','Cart | Foodstagram')
@section('css')
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection
@section('content')
<div>
    <h3 class="top text-center my-1"><strong>Your Shopping Cart</strong></h3>
</div>
<div class="container-fluid mt-4 pb-5">
    <div class="row">
        <div class="col-xxl-8 col-xl-9 col-12">
            <div class="card">
                <div class="card-body" id="items">
                    <div class="row justify-content-between mt-3 px-5">
                        <div class="itemCount col-xl-6 col-xxl-6 col-12">
                            
                        </div>
                        <div class="col-xl-6 col-xxl-6 col-12">
                            <a href="" class="removeAll text-danger"><i class="fas fa-trash-alt"></i>&nbsp;Remove All</a>
                        </div>
                    </div>
                    <span class="cartData">
                    
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-3 col-12" id="receipt">
            <div id="receipt-form">
                <div class="card">
                    <div class="card-body px-4">
                        <h5 class="text-center text-white mt-1">Your Receipt</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between border-0 px-0 pb-2">
                                Temporary Amount
                                <span class="totl_amt">0 Kyat</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between px-0 pb-0">
                                Delivery Fees (Constant)
                                <span>2500 Kyats</span>
                            </li>
                            <hr style="color:white;">
                            <li class="list-group-item d-flex justify-content-between border-0 px-0 pb-2">
                                Total Amount
                                <span class="final_amt">0 Kyat</span>
                            </li>
                        </ul>
                        <p class="sry text-center mt-1">* We are sorry that we  accept orders only from Yangon.If your order's location isn't from Yangon,it will be cancelled.We are improving our delivery service to get other town.So please wait for us.<br>Thank you for choosing us<3</p>
                    </div>
                </div><!--card-->
                <div class="card mt-3">
                    <div class="card-body">
                        <p class="pt-3">
                            <a class="location d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#location_form" aria-expanded="false" aria-controls="collapseExample">
                                Add Your Location
                                <i class="fas fa-chevron-down pt-1"></i>
                            </a>
                        </p>
                        <div class="collapse" id="location_form">
                            
                            <div class="form-check mt-4 mb-3">
                                <input class="form-check-input" type="radio" name="location" id="d_add" checked="checked">
                                <label class="form-check-label text-white" for="d_add">
                                    Your default address 
                                </label>
                                <div class="card card-body">
                                    <input type="text" id="d_location" class="form-control d-inline-block" value="{{Auth::guard('customer')->user()->location}}" disabled>
                                </div>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="location" id="c_add">
                                <label class="form-check-label text-white" for="c_add">
                                    If you are not in your default address,enter your current location.
                                </label>
                                <div class="card card-body">
                                    <div class="form-floating mb-3">
                                        <textarea id="location" class="form-control" placeholder="Enter Your Location" id="floatingTextarea" name="current_location" disabled></textarea>
                                        <label for="floatingTextarea">Enter your home number,street name,block and township</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--card-body-->
                </div><!--card-->
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-primary" id="checkout" data-user="{{  Auth::guard('customer')->id() }}">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="scrollTop">
    <button id="gbtt" class="btn "onclick="scrollToTop()"><i class="fas fa-chevron-up"></i><br>Go Back To Top</button>
</div>
<div class="modal fade" id="rmkModal" tabindex="-1" aria-labelledby="rmkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                                    
        </div>
    </div>
</div>
@endsection
@push('functions')
    refresh();
    
@endpush
@push('js')
 <script src="{{asset('js/frontend/cart.js')}}"></script>
@endpush