<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ,user-scalable=no">
    <title>@yield('pageTitle')</title>
    <!-- CSS only -->
    <script src="{{asset('https://kit.fontawesome.com/1e9d4689e4.js')}}" crossorigin="anonymous"></script>
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('https://unpkg.com/aos@2.3.1/dist/aos.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('css/asdf.css')}}"> -->
    @yield('css')
</head>
<body oncontextmenu="return true">
    @include('frontend.navbar')
    @yield('content')
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('https://unpkg.com/aos@next/dist/aos.js')}}"></script>
    @stack('js')
    <script>
        AOS.init();
    </script>
    <script>
        $(document).ready(function(){
            count_item();
        function count_item(){      
                var cart=localStorage.getItem("cart");
                if(cart){
                    var cartobj=JSON.parse(cart);
                    var total=0;
                    $.each(cartobj.itemlist,function(i,v){
                    total+=parseInt(v.qty);               
                    });
                    $("#cart-badge").html(total);
                }
            }
            @stack('functions')
        })
    </script>
</body>
</html>