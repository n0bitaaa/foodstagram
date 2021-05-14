@extends('frontend.template')
@section('pageTitle','Home | Foodstagram')
@section('css')
 <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection
@section('content')
    <div id="first">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-12"><img src="{{ asset('images/fried-rice.png') }}" alt=""></div>
                <div class="col-xl-6 col-md-12">
                    <i>We have Your Favourite Chief.</i> <br>
                    <span id="one">We promise for your <span class="two">fun</span> and your <span class="two">food</span>.</span><br>
                    <a href="shop" class="btn btn-primary rounded-pill mt-5" id="shop-btn">Let's Shop</a>
                    <i><span id="mmlink">Supported by <span id="mm">Myanmar</span> <span id="links">Links</span></span></i>
                </div>
            </div>
        </div>
    </div><!--first-->
    <div id="second">
        <div id="quote" data-aos="fade-up" data-aos-duration="1000">
            <p class="text-center">
            “Life is like a <span>restaurant</span>; you can have anything you want as long as you are willing to pay the price.”
            </p>
            <p class="text-right mt-1">
                ~Moffat Machingura
            </p>
        </div><!--quote-->
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-12" data-aos-duration="1000">
                    <p>About</p>
                    <span>How we make?</span><br>
                    <span style="font-size: 19px;" class="d-block mt-2">We make our products with best ingredients and good quality.We provide every food with our love and kindness.</span><br>
                    <a href="#" class="btn btn-primary rounded-pill float-right">Learn More</a>
                </div>
                <div class="col-xl-6 col-md-12" data-aos="flip-left" data-aos-duration="1000"><img src="images/b1185f38c45c35ca2956acf2b6b16077 1.png" alt="breakfast"></div>
            </div>
        </div>
    </div><!--second-->
    <div id="third">
        <div id="top">
            <img src="images/undraw_breakfast_psiw 1.png" alt="picture" class="d-block" data-aos="flip-left" data-aos-duration="1500">
            <p data-aos="fade-in" data-aos-duration="1500">We truely deliver your orders with fast and best quality.You can trust our <span>customer</span> service.</p>
        </div><!--top-->
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-12" data-aos-duration="1000">
                    <img src="images/undraw_shopping_app_flsj 1.png" alt="shopping_cart">
                </div>
                <div class="col-xl-6 col-md-12" data-aos-duration="1000">
                <div id="shell">
                    <p class="one">Order</p>
                    <p class="twoo">How to order?</p>
                    <p class="three">You can choose your foods from the shop,add items to your cart and order easily with one touch.</p>
                        <img src="images/undraw_diet_ghvw 1.png" alt="diet">
                    </div><!--shell-->
                </div>
            </div>
        </div>
    </div><!--third-->
    <div id="four">
        <div class="container">
            <div class="row pt-4">
                <div class="col-xl-3 col-xxl-3 col-md-6 col-12">
                    <div class="col-12" data-aos="flip-left" data-aos-duration="1000">
                    <img src="images/attach_money_24px.png" alt="dollar" class="d-block mx-auto mt-1 mb-2">
                    <span><span class="headOne">Fair</span> Price</span>
                    <p class="body mt-1">We provide all kinds of flavoured foods with very fair price.</p>
                    </div>
                </div><!--col-3-->
                <div class="col-xl-3 col-xxl-3 col-md-6 col-12">
                    <div class="col-12" data-aos="flip-right" data-aos-duration="1000">
                        <img src="images/package.png" alt="dollar" class="d-block mx-auto" width="114px" height="84px">
                        <span><span class="headTwo">Well</span> Packaging</span>
                        <p class="bodyy mt-1">Packaging can be theatre,it can create a story.So,we package our foods with best quality.</p>
                    </div>
                </div><!--col-3-->
                <div class="col-xl-3 col-xxl-3 col-md-6 col-12">
                    <div class="col-12" data-aos="flip-left" data-aos-duration="1000">
                        <img src="/images/bik.png" alt="dollar" class="d-block mx-auto" width="114px" height="82px">
                        <span><span class="headThree">Fast</span> Delivery</span>
                        <p class="body mt-1">We deliver your orders faster than your crush’s reply.</p>
                    </div>
                </div><!--col-3-->
                <div class="col-xl-3 col-xxl-3 col-md-6 col-12">
                    <div class="col-12" data-aos="flip-right" data-aos-duration="1000">
                        <img src="/images/thumb up.png" alt="dollar" class="d-block mx-auto" width="114px" height="82px">
                        <span><span class="headFour">Easy</span> to Order</span>
                        <p class="body mt-1">You can easily order with just one click or one touch from us .</p>
                    </div>
                </div><!--col-3-->
            </div>
        </div><!--container-->
        <div class="container" id="bottom">
            <div class="row"  data-aos="zoom-in" data-aos-duration="1000">
                <div class="col-xl-6 col-12" id="a">
                    <img src="images/download 1.png" alt="human" class="d-block mx-auto mt-5">
                </div>
                <div class="col-xl-6 col-12" id="b">
                    <span>We are always ready to fulfill your wished order.If u have any problems,you can contact us from the the below button.</span><br>
                    <a href="#" class="btn btn-primary rounded-pill mt-5" id="ctUs">Contact Us</a>
                </div>
            </div>
        </div>
    </div><!--four-->
    <div id="footer">
        <p class="pt-3">2020@copyright.All rights reserved.</p>
    </div><!--footer-->
    <div id="goTop">
        <button class="btn">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>
@endsection
@push('functions')
$('#goTop .btn').click(function(){
    if(navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) {           
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    }else{
                $('html,body').animate({
                    scrollTop: 0,
                    scrollLeft: 0
                }, 150, function(){
                    $('html,body').clearQueue();
                });
    }
})
@endpush