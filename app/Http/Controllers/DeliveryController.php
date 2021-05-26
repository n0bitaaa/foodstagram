<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Delivery;
use App\Delivery_men;
use App\User;
use App\Order;
use App\Mail\DeliveryFinish;
use App\Customer;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::with('user','delivery_men')
                            ->orderBy('id','desc')
                            ->paginate(10);
        $orders = Order::with('customer')->get();
        return view('delivery.index',compact('deliveries','orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = Order::where('state','=','1')->get();
        $deliverymens = Delivery_men::where('status','=','0')->get();
        return view('delivery.create',compact('orders','deliverymens'));
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
            'delivery_men_id' => 'required',
            'order_id' => 'required',
        ]);
        Delivery::create([
            'order_id' => $request->order_id,
            'delivery_men_id' => $request->delivery_men_id,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);
        $deliverymen = Delivery_men::findOrFail($request->delivery_men_id);
        $deliverymen->status=1;
        $deliverymen->save();
        $order = Order::findOrFail($request->order_id);
        $order->state=3;
        $order->save();
        Session::flash('success',"Created Successfully!");
        return redirect()->route('deliveries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('delivery.show',compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orders = Order::all();
        $deliverymens = Delivery_men::all();
        $delivery = Delivery::findOrFail($id);
        return view('delivery.edit',compact('delivery','orders','deliverymens'));
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
            'delivery_men_id' => 'required',
            'order_id' => 'required',
        ]);
        $delivery = Delivery::findOrFail($id);
        $delivery->order_id = $request->order_id;
        $delivery->delivery_men_id = $request->delivery_men_id;
        $delivery->user_id = Auth::user()->id;
        $delivery->save();
        $deliverymen = Delivery_men::findOrFail($request->delivery_men_id);
        $deliverymen->status=1;
        $deliverymen->save();

        Session::flash('edit','Edited Successfully!');
        return redirect()->route('deliveries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Delivery::findOrFail($id)->delete();
        Session::flash('delete',"Deleted Successfully!");
        return redirect()->route('deliveries.index');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $orders = Order::with('customer')->get();
        $a = $request->delivery;
        $deliveries = Delivery::where('id','LIKE','%'.$a.'%')
                    ->orWhere('delivery_men_id','LIKE','%'.$a.'%')
                    ->orWhere('order_id','LIKE','%'.$a.'%')
                    ->orWhere('user_id','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('delivery.index',compact('deliveries','order_0','orders'));
        
    }

    public function finish($id){
        Delivery::where('id',$id)->update(['status'=>'1']);
        $orders = Delivery::findOrFail($id)->order_id;
        $order = Order::findOrFail($orders);
        $customers = $order->customer_id;
        $customer = Customer::findOrFail($customers);
        $customer_email = $customer->email;
        $order->state=4;
        $order->save();
        $deliverymens = Delivery::findOrFail($id)->delivery_men_id;
        $deliverymen = Delivery_men::findOrFail($deliverymens);
        $deliverymen->status=0;
        $deliverymen->save();
        $details = [
            'name'=>$customer->name,
            'code'=>$order->code

        ];
        \Mail::to($customer_email)->send(new DeliveryFinish($details));
        Session::flash('finish',"An order just finished!");
        return redirect()->route('deliveries.index');
    }
}
