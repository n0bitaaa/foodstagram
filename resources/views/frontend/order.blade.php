@extends('frontend.template')
@section('pageTitle','Orders | Foodstagram')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection
@section('content')
    <div class="container-fluid mt-5" id="main">
        <div class="row">
            <div class="col-xxl-9 col-xl-8 col-12" id="orders">
                @if(Session::has('success'))
                    <p class="text-center alert alert-success">{{ Session::get('success') }}</p>
                @endif
                @if(Session::has('delete'))
                    <p class="text-center alert alert-danger">{{ Session::get('delete') }}</p>
                @endif
                <div class="card px-5">
                    <h3 class="text-center pageTitle mt-4"><b>Active Orders</b></h3>
                    <div class="card-body">
                        <span class="orderData">
                        @forelse($p_orders as $p_order)
                            <div class="row my-5">
                                <div class="col-xxl-2 col-xl-3 col-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center" id="orderPending" title="Order Pending">
                                            <i class="fas fa-question text-white"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3 d-flex justify-content-center">
                                        <a href="{{ url('/orders/delete',$p_order->id) }}"><button class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order?')">Cancel Order</button></a>
                                    </div>
                                </div> 
                                <div class="col-xxl-10 col-xl-9 col-12 p-0">
                                    <div class="detail text-white">
                                        <span class="time">{{ \Carbon\Carbon::parse($p_order->created_at)->toFormattedDateString() }}&nbsp;&nbsp;{{ \Carbon\Carbon::parse($p_order->created_at)->format('h:i A') }}&nbsp;&nbsp;&nbsp;&nbsp;({{ number_format($p_order->totl_amt) }} Kyats)</span><br>
                                        <span class="order-code">Order code = {{ $p_order->code }}	 </span><br>
                                        @foreach($p_order->foods as $food)
                                        <span>{{ $food->pivot->qty }} x {{ $food->food_name }} ({{ number_format($food->pivot->qty*$food->pivot->price) }} Kyats)</span> |
                                        @endforeach
                                        <br>
                                        <span style="text-transform:capitalize;">Address - {{ $p_order->current_location }}</span><br>
                                    </div>
                                </div>
                           </div><!--row-->
                            <hr style="color:#e0e0e0;height:2px;">
                        @empty
                            <div class="row my-5">
                                <div class="col">
                                    <h4 class="text-center text-muted">You have no active orders.</h4>
                                </div>
                            </div>
                        @endforelse
                        </span><!--span-->
                    </div><!--card-body-->
                </div><!--card-->

                <div class="card px-5 mt-5 mb-5">
                    <h3 class="text-center pageTitle mt-4"><b>Past Orders</b></h3>
                    <div class="card-body">
                        <span class="orderData">
                        @forelse($orders as $order)
                            <div class="row my-5">
                                <div class="col-xxl-2 col-xl-3 col-12">
                                    @if($order->state==2)
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex align-items-center justify-content-center" id="orderCancel" title="Order Cancel">
                                                <i class="fas fa-times text-white"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex align-items-center justify-content-center" id="orderAccept" title="Order Accept">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                        </div>
                                    @endif
                                </div> 
                                <div class="col-xxl-10 col-xl-9 col-12 p-0">
                                    <div class="detail text-white">
                                        <span class="time">{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}&nbsp;&nbsp;{{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}&nbsp;&nbsp;&nbsp;&nbsp;({{ number_format($order->totl_amt) }} Kyats)</span><br>
                                        <span class="order-code">Order code = {{ $order->code }}	 </span><br>
                                        @foreach($order->foods as $food)
                                        <span>{{ $food->pivot->qty }} x {{ $food->food_name }} ({{ number_format($food->pivot->qty*$food->pivot->price) }} Kyats)</span> |
                                        @endforeach
                                        <br>
                                        <span style="text-transform:capitalize;">Address - {{ $order->current_location }}</span><br>
                                    </div>
                                    <div class="px-4">
                                        <button class="btn btn-primary" id="reorder" style="float:right;"data-info="{{ $order }}">Reorder</button>
                                    </div>
                                </div>
                           </div><!--row-->
                            <hr style="color:#e0e0e0;height:2px;">
                        @empty
                            <div class="row my-5">
                                <div class="col">
                                    <h4 class="text-center text-muted">You have no past orders.</h4>
                                </div>
                            </div>
                        @endforelse
                        </span><!--span-->
                    </div><!--card-body-->
                </div><!--card-->
            </div><!--col-9-->
            
            <div class="col-xxl-3 col-xl-4 col-12">
                <div style="position:sticky;top:110px;">
                    <div class="card" id="progress">
                        <div class="card-body">
                            <h4 class="text-uppercase my-2">your progress</h4>
                            <p  class="text-white text-center my-4">
                                <strong>
                                @if($pc_orders==0)
                                    You have no pending orders.
                                @else
                                    You have <span id="orderCount" class="d-inline-block">{{ $pc_orders }}</span> pending orders.
                                @endif
                                </strong>
                            </p>
                        </div><!--card-body-->
                    </div><!--card-->
                    
                    <div class="card mt-4">
                        <div class="card-body" id="note">
                            <h3 class="text-center my-3" style="color:#c4c4c4;"><strong>Notes</strong></h3>
                            <div class="row my-4">
                                <div class="col-xxl-3 col-xl-4 col-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center" id="orderPending1">
                                            <i class="fas fa-question text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-9 col-xl-8 col-12">
                                    <h5 class="text-white mt-1"><strong>Pending</strong></h5>
                                    <p class="text-white mt-3" id="pendingText">Your order has not been accepted yet.</p>
                                </div>
                            </div><!--row-->
                            <hr style="color:white;">

                            <div class="row my-4">
                                <div class="col-xxl-3 col-xl-4 col-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center" id="orderAccept1">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-9 col-xl-8 col-12">
                                    <h5 class="text-white mt-1"><strong>Accept</strong></h5>
                                    <p class="text-white mt-3" id="acceptText">Your order has been accepted.Check your email for receipt.</p>
                                </div>
                            </div><!--row-->
                            <hr style="color:white;">

                            <div class="row my-4">
                                <div class="col-xxl-3 col-xl-4 col-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center" id="orderCancel1">
                                            <i class="fas fa-times text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-9 col-xl-8 col-12">
                                    <h5 class="text-white mt-1"><strong>Cancel</strong></h5>
                                    <p class="text-white mt-3" id="cancelText">Your order has been cancelled due to some reasons.</p>
                                </div>
                            </div><!--row-->
                            <hr style="color:white;" class="mb-5" id="hr">
                        </div>
                    </div>
                </div>
            </div><!--col-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
@push('js')
    <script src="{{ asset('js/frontend/order.js') }}"></script>
@endpush
@push('functions')
    setTimeout(function(){
   $("p.alert").remove();
}, 4000 );
@endpush