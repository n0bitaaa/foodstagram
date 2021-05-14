@extends('frontend.template')
@section('pageTitle','Shop | Foodstagram')
@section('css')
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
@endsection
@section('content')
<input class="form-control py-2 mt-4 bar rounded-pill" data-aos="fade-down" data-aos-duration="800" type="search" id="search" placeholder="Type to find a food..." aria-label="Search" autocomplete="off">

<div class="container-fluid" id="shop">
    <div class="row">
    <div class="d-none mb-4" id="cc">
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="true" aria-controls="category"><i class="fas fa-bars text-white"></i></button>
    </div>
        <div class="col-xxl-2 col-xl-2 col-12 mb-5 collapse show" id="category">
            <div class="card text-center" data-aos="slide-right" data-aos-duration="800">
                <div class="card-header mt-2">
                    Categories
                </div>
                <ul class="card-body">
                    <li class="nav-link active rounded-pill">
                      <a href="/shop" class="nav-item">All Foods</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-link rounded-pill mt-1">
                            <a href="/shop/filter?category={{$category->id}}" class="nav-item">{{$category->name}}</a>
                        </li>
                    @endforeach
                  </ul>
            </div>
        </div><!--category-->
        <div class="col-xxl-8 col-xl-7 col-12 overflow-auto" id="foods">
           <div class="container">
               <div class="row">
                    @foreach($foods as $food)
                        <div class="col-xxl-3 col-xl-4 col-12 mb-3">
                            <div class="card shadow">
                                <img src="{{ $food->image }}" alt="food_image" class="card-img-top">
                                <div class="card-body clearfix">
                                    <h6 class="text-center">{{ $food->food_name }}</h6>
                                    <h6 class="text-center">{{ number_format($food->price) }} Kyats</h6>
                                    <a class="plus btn" data-info="{{ $food }}"><i class="fas fa-plus"></i></a>
                                    <a class="view btn" id="eye" data-info="{{ $food }}" data-bs-toggle="modal" data-bs-target="#viewModal" aria-hidden="true"><i class="fas fa-eye"></i></a>
                                        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                    
                                                </div>
                                            </div>
                                        </div>
                                </div> 
                            </div>
                        </div><!--col-3-->
                    @endforeach
                 </div><!--row-->
           </div>
        </div><!--foods-->
        <div class="col-xxl-2 col-xl-3 col-12" id="cart"  data-aos="flip-right" data-aos-duration="800">
           <div class="card text-center">
               <div class="card-header p-3">Your Cart</div>
               <table class="table table-borderless text-white">
                    <thead>
                        <td>Item</td>
                        <td>Quantity</td>
                        <td>Price</td>
                    </thead>
                    <tbody id="bill-data">

                    </tbody>
                    <tfoot>
                        <td></td>
                        <td>Total</td>
                        <td id="bill-total">0 Kyat</td>
                    </tfoot>
               </table>
               <div class="d-block">
                   <a href="{{ url('/cart') }}" class="btn btn-primary rounded-pill mb-4 disabled" id="gtc">Go To Checkout</a>
               </div>
           </div>
        </div><!--cart-->
    </div>
</div>
<div id="footer">
    <p class="pt-3 mt-5">2020@copyright.All rights reserved.<br>DancingDogs</p>
</div><!--footer-->
<div id="goCheck">
    <button id="gc" class="btn">Checkout<br><i class="fas fa-chevron-down"></i></button>
</div>
@endsection
@push('functions')
    refresh();
    $(function(){
    $('#category .card-body a').filter(function(){
        return this.href==location.href
    }).parent().addClass('active').siblings().removeClass('active');
});
$('#search').keyup(function(){  
        search_table($(this).val());  
   });  
   function search_table(value){  
        $('#foods .col-xxl-3').each(function(){  
             var found = 'false';  
             $(this).each(function(){  
                  if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                  {  
                       found = 'true';  
                  }  
             });  
             if(found == 'true')  
             {  
                  $(this).show();  
             }  
             else  
             {  
                  $(this).hide();  
             }  
        });  
    }
    $('#gc').click(function(){
        window.scrollTo(0,2000)
    })
@endpush
@push('js')
    <script src="{{ asset('js/frontend/shop.js') }}"></script>
@endpush