@extends('frontend.template')
@section('pageTitle','About | Foodstagram')
@section('css')
    <link rel="stylesheet" href="{{asset('css/about.css')}}">
@endsection
@section('content')
<div class="ab-first">
    <div class="container">
      <div class="ab-pic">
          <img src="images/140824936-ohn-no-khao-swe-on-white-marble-background-oh-no-khao-suey-is-coconut-milk-noodle-soup-of-myanmar-cu.jpg" alt="banner1">
        </div>
        <div class="about">
          <h1>About Us</h1>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</br> Libero dignissimos
            ipsa voluptatum tempore molestiae</br> explicabo quasi saepe similique,
          odio nulla deserunt iusto illum.</br> Quo porro beatae doloribus laborum nisi facilis!</p>
        </div>
    </div>  
  </div>
  <div class="ab-sec">  
    <div class="container">
      <div class="our-story">
        <h1 class="text-center pt-5">Our Story</h1>
        <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea animi libero velit sapiente exercitationem nulla, ipsum officiis debitis assumenda</br> quod autem corrupti, amet dolorum, ducimus doloremque nesciunt perferendis. Voluptates, recusandae Lorem ipsum dolor sit amet,</br> consectetur adipisicing elit. Vel molestiae excepturi odio! Minus, omnis voluptatem! Facilis quod voluptas officiis, quibusdam earum qui</p>
      </div>
        <div class="d-flex justify-content-around align-items-center">
            <div class="eat">
                <img src="images/undraw_eating_together_tjhx-removebg-preview.png" alt="eat">
            </div>
            <div class="spe-even">
                <img src="images/undraw_special_event_4aj8-removebg-preview.png" alt="spe-even">
            </div>
        </div>
    </div>
  </div>

  <div class="ab-third">
    <div class="container">
        <div class="row">
                <div class="o-u col-6">
                    <h1>Our Cuisine</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione,<br> sapiente ullam quod, beatae, corporis in blanditiis eum distinctio quis natus<br> id molestias dicta. Quasi nostrum animi iure voluptas hic consequatur Lorem,<br> ipsum dolor sit amet consectetur adipisicing elit. Ratione dolorum <br> eos officiis numquam. Qui optio alias quia iusto reiciendis accusantium ad</p>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div class="pic-1 px-4">
                        <img src="images/cola.jpg" alt="">
                    </div>
                    <div class="pic-2 px-4 pt-5">
                        <img src="images/0c64d556a09b14ad1296b54bc92a5218.jpg" alt="">
                    </div>
                </div>
        </div>
    </div>
  </div>
@endsection