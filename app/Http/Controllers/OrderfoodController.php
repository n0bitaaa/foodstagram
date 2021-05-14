<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_food;
use App\Order;
use App\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class OrderfoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        $orderdetails = Order_food::paginate(5);
        return view('orderdetail.index',compact('orderdetails','foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods = Food::all();
        $orders = Order::all();
        return view('orderdetail.create',compact('orders','foods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'food_id' => 'required',
            'qty' => 'required',
            'order_id' => 'required',
            'rmk' => 'required'
        ]);
        Order_food::create([
            'food_id' => $request->food_id,
            'qty' => $request->qty,
            'price' => $request->price,
            'rmk' => $request->rmk,
            'order_id' => $request->order_id
        ]);
        Session::flash('success','Created Successfully!');
        return redirect()->route('orderdetails.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetail = Order_food::findOrFail($id);
        return view('orderdetail.show',compact('orderdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foods = Food::all();
        $orders = Order::all();
        $orderdetail = Order_food::findOrFail($id);
        return view('orderdetail.edit',compact('orders','foods','orderdetail'));
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
        $request -> validate([
            'food_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'rmk' => 'required',
            'order_id' => 'required'
        ]);
        $orderdetail = Order_food::findOrFail($id);
        $orderdetail->food_id = $request->food_id;
        $orderdetail->qty = $request->qty;
        $orderdetail->price = $request->price;
        $orderdetail->rmk = $request->rmk;
        $orderdetail->order_id = $request->order_id;
        $orderdetail->save();

        Session::flash('edit',"Edited Successfully!");
        return redirect()->route('orderdetails.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_detail = Order_food::findOrFail($id);
        $order_detail->delete();

        Session::flash('delete',"Deleted Successfully!");
        return redirect()->route('orderdetails.index');
    }

    public function search(Request $request){
        $a = $request->orderdetail;
        $orderdetails = Order_food::where('id','LIKE','%'.$a.'%')
                    ->orWhere('food_id','LIKE','%'.$a.'%')
                    ->paginate(2);
        return view('orderdetail.index',compact('orderdetails'));
        
    }
}
