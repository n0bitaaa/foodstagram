<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/home',function(){
//     return view('welcome');
// });
// Route::get('/homee','HomeController@index');
Route::group(['prefix'=>'admin'],function(){
    Auth::routes(['verify'=>true,'register'=>true]);
});

Route::group(['middleware' => 'auth','prefix'=>'admin'],function(){

    Route::get('/dashboard','DashboardController@index')->name('dashboard.index');

    Route::resource('/users','UserController');
    
    Route::resource('/categories','CategoryController');

    Route::resource('/foods','FoodController');

    Route::resource('/deliverymens','DeliverymenController');

    Route::resource('/deliveries','DeliveryController');

    Route::resource('/customers','CustomerController');

    Route::resource('/orderfoods','OrderfoodController');

    Route::get('/search/users','UserController@search');

    Route::get('/search/orderfoods','OrderfoodController@search');

    Route::get('/search/orders','OrderController@search');

    Route::get('/search/foods','FoodController@search');

    Route::get('/search/deliverymens','DeliverymenController@search');

    Route::get('/search/deliveries','DeliveryController@search');

    Route::get('/search/customers','CustomerController@search');

    Route::get('/search/categories','CategoryController@search');

    Route::get('/orders/active/{id?}','OrderController@active_order')->name('orders.active');

    Route::get('/orders/decline/{id?}','OrderController@decline_order')->name('orders.decline');

    Route::get('/deliverymens/available/{id?}','DeliverymenController@available')->name('deliverymens.available');

    Route::get('/deliverymens/unavailable/{id?}','DeliverymenController@unavailable')->name('deliverymens.unavailable');

    Route::get('/deliveries/finish/{id?}','DeliveryController@finish')->name('deliveries.finish');

    Route::resource('/orders',"OrderController"); 

});

Route::get('/login','Auth\LoginController@showCustomerLoginForm')->name('login.customer');

Route::post('/login','Auth\LoginController@customerLogin');

Route::get('/register','Auth\LoginController@showCustomerRegisterForm')->name('register.customer');

Route::post('/register','Auth\LoginController@customerRegister');

Route::post('/logout','Auth\LoginController@logout');

Route::view('/','frontend.index')->name('asdf');

Route::get('/shop/filter','FoodController@sortCategory');

Route::get('/shop','FoodController@allFood')->name('shop');

Route::view('/about','frontend.about');

Route::view('/contact','frontend.contact');

Route::group(['middleware' => ['auth:customer','verified']],function(){
    Route::get('/cart','OrderController@cart');

    Route::post('/gotocheck','OrderController@goToCheck')->name('gotocheck');

    Route::get('/orders','OrderController@allOrder')->name('order');

    Route::get('/orders/delete/{id?}','OrderController@destroyOrder');

    Route::get('/profile','ProfileController@index')->name('profile');

    Route::post('/profilepic-update/{id?}','ProfileController@updatePic')->name('picUpdate');

    Route::post('/detail-update/{id?}','ProfileController@updateDetail')->name('detailUpdate');

    Route::post('/password-update/{id?}','ProfileController@updatePass')->name('passUpdate');
});

