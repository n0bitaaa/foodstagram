<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Food;
use App\Order;
use App\Customer;
use App\Delivery;
use App\Delivery_men;

class DashboardController extends Controller
{
    public function index(){
        $new_customers = Customer::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        $data['pieChart'] = Order::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month_name')
                    ->orderBy('count')
                    ->get();
        $users = User::all()->count();
        $categories = Category::all()->count();
        $foods = Food::all()->count();
        $orders = Order::all()->count();
        $orderss = Order::where('state',1)
                        ->orWhere('state',3)
                        ->orWhere('state',4)
                        ->get();
        $total_earnings = 0;
        foreach($orderss as $order){
            $total_earnings += $order->totl_amt;
        }
        $order_0 = Order::where('state',0)->get()->count();
        $order_2 = Order::where('state',2)->get()->count();
        $order_3 = Order::where('state',3)->get()->count();
        $order_4 = Order::where('state',4)->get()->count();
        $customers = Customer::all()->count();
        $deliveries = Delivery::all()->count();
        $deliverymens = Delivery_men::all()->count();
        return view('dashboard.index',compact('users','categories','foods','orders','customers','deliveries','deliverymens','new_customers','data','total_earnings','order_0','order_2','order_3','order_4'));
    }
}
