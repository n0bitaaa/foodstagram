<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use Notification;
Use App\Order_food;
use App\Mail\OrderAccept;
use App\Mail\OrderDecline;
Use App\Food;
Use Carbon\Carbon;
Use App\Delivery;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('customer')
                        ->orderBy('id','desc')
                        ->paginate('10');
        $order_0 = Order::where('state',0)->get()->count();
        return view('order.index',compact('orders','order_0'));
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function goToCheck(Request $request)
    {
        $foods = $request->itemlist;
        $data = $request->data;
        $uuid = Str::uuid();

        $subtotal =  $tot_qty = 0;
        foreach($foods as $food){
            $subtotal += $food['price'] * $food['qty'];
            $tot_qty += $food['qty'];
        }
    
        $order = Order::create([
            'code' => $uuid,
            'current_location' => $data['location'],
            'tot_qty' => $tot_qty,
            'totl_amt' =>$subtotal ,
            'state' => 0,
            'customer_id' => Auth::guard('customer')->id(),
        ]);
        foreach($foods as $food){
            $order->foods()->attach($food['id'],['qty' => $food['qty'],'rmk' => $food['rmk'],'price'=> $food['price'] ]);
        }
        Session::flash('success',"Ordered Successfully!");
       return true;
    }

    public function allOrder()
    {
        $id = Auth::guard('customer')->id();
        $orders = Order::where('state',1)
                        ->orWhere('state',2)
                        ->orWhere('state',3)
                        ->orWhere('state',4)
                        ->having('customer_id',$id)
                        ->orderBy('id','desc')->get();
        $p_orders = Order::where('customer_id',$id)->having('state',0)->orderBy('id','desc')->get();
        $pc_orders = Order::where('customer_id',$id)->having('state',0)->get()->count();
        return view('frontend.order',compact('orders','pc_orders','p_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods = Food::all();
        return view('order.create',compact('foods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_location'=>'required',
        ]);
        $uuid = Str::uuid();
        $total_amount = 0;
        $foods = $request->input('foods', []);
        $quantities = $request->input('quantities', []);
        $rmks = $request->input('remarks',[]);
        for ($food=0;$food < count($foods); $food++) {
            $foodprices = Food::findOrFail($foods[$food])->price;
            $quantity= $quantities[$food];
            $total_amount += $foodprices*$quantity;
        }
        $order = new Order;
        $order->code=$uuid;
        $order->current_location=$request->current_location;
        $order->tot_qty=array_sum($quantities);
        $order->totl_amt=$total_amount;
        $order->state=0;
        $order->customer_id=Auth::guard('customer')->id();
        $order->created_at = Carbon::now();
        $order->save();

        for ($food=0;$food < count($foods); $food++) {
            $food_prices = Food::find($foods[$food]);
            $food_price = $food_prices->price;
        if ($foods[$food] != '') {
            $order->foods()->attach($foods[$food],['qty' => $quantities[$food],'rmk' => $rmks[$food],'price'=> $food_price ]);
        }
    }
        Session::flash('success','Created Successfully');
        Session::flash('code', $uuid);
        return redirect()->route('orders.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_0 = Order::where('state',0)->get()->count();
        $orders = Order::where('id',$id)->with('foods')->get();
        return view('order.show',compact('orders','order_0'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code'=>'required',
            'current_location'=>'required',
            'tot_qty'=>'required',
            'totl_amt'=>'required',
        ]);
        $order = Order::findOrFail($id);
        $order->code=$request->code;
        $order->current_location=$request->current_location;
        $order->tot_qty=$request->tot_qty;
        $order->totl_amt=$request->totl_amt;
        $order->customer_id=Auth::guard('customer')->id();
        $order->save();
        Session::flash('edit','Edited Successfully!');
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $delivery = Delivery::where('order_id',$id)->delete();
        $order_food = Order_food::where('order_id',$id)->delete();
        $order->delete();
        Session::flash('delete','Deleted Successfully!');
        return redirect()->route('orders.index');
    }

    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $delivery = Delivery::where('order_id',$id)->delete();
        $order_food = Order_food::where('order_id',$id)->delete();
        $order->delete();
        Session::flash('delete','Cancelled Successfully!');
        return redirect()->route('order');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $a = $request->order;
        $orders = Order::where('id','LIKE','%'.$a.'%')
                    ->orWhere('code','LIKE','%'.$a.'%')
                    ->orWhere('current_location','LIKE','%'.$a.'%')
                    ->orWhere('tot_qty','LIKE','%'.$a.'%')
                    ->orWhere('totl_amt','LIKE','%'.$a.'%')
                    ->orWhere('state','LIKE','%'.$a.'%')
                    ->orWhere('customer_id','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('order.index',compact('orders','order_0'));
        
    }

    public function active_order($id){
        $details = [];
        Order::where('id',$id)->update(['state'=>'1']);
        Session::flash('accept',"Accepted Successfully!");
        $order = Order::findOrFail($id);
        $customers = $order->customer_id;
        $customer = Customer::findOrFail($customers);
        $customer_email = $customer->email;
        $order_details = Order_food::where('order_id',$order->id)->get();
        $user_id = Auth::user()->id;
        Order::where('id',$id)->update(['user_id'=>$user_id]);
        foreach($order_details as $order_detail){
        $food = $order_detail->food_id;
        $foods = Food::find($food);
        $food_names = $foods->food_name;
        
        $detail = 
        [
            'name'=> $customer->name,
            'order_code'=> $order->code,
            'location'=>$order->current_location,
            'items'=>$food_names,
            'qty'=>$order_detail->qty,
            'price'=>$foods->price,
            'total_price'=>$order_detail->price,
            'order_total_price'=>$order->totl_amt,
            'date'=>Carbon::now()->timezone('Asia/Yangon')->toDayDateTimeString(),
            'current_location'=>$order->current_location
        ];
        array_push($details,$detail);
        }
        \Mail::to($customer_email)->send(new OrderAccept($details));
        Session::flash('accept',"Accepted Successfully!");
        return redirect()->route('orders.index');   
        
     
    }

    public function decline_order($id){
        Order::where('id',$id)->update(['state'=>'2']);
        Session::flash('decline',"Declined Successfully!");
        $order = Order::findOrFail($id);
        $customers = $order->customer_id;
        $customer = Customer::findOrFail($customers);
        $customer_email = $customer->email;
        $user_id = Auth::user()->id;
        Order::where('id',$id)->update(['user_id'=>$user_id]);
        $details = [
            'name'=> $customer->name,
            'order_code'=> $order->code,
            'date'=>Carbon::now()->timezone('Asia/Yangon')->toDayDateTimeString(),
        ];
        \Mail::to($customer_email)->send(new OrderDecline($details));
        Session::flash('decline',"Declined Successfully!");
        return redirect()->route('orders.index');
    }
}
