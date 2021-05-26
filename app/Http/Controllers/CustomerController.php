<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Order;
use App\Order_food;
use App\Delivery;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $customers = Customer::paginate(5);
        return view('customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|min:4|max:255',
            'password'=>'required|min:8|max:255|confirmed',
            'email'=>'required',
            'phone'=>'required',
            'image'=>'required|mimes:jpeg,png,pdf,jpg|max:8192',
            'location'=>'required|min:8'
        ]);
        $file = $request->image;
        $extension = $file->extension();
        $uuid = Str::uuid();
        $request->image->storeAs('/public', $uuid.".".$extension);
        $url = Storage::url($uuid.".".$extension);
        $customer = new Customer;
        $customer->id = $request->id;
        $customer->name = $request->name;
        $customer->password = bcrypt($request->password);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->image = $url;
        $customer->location = $request->location;
        $customer->save();
        Session::flash('success',"Created Successfully!");
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit',compact('customer'));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $orders = Order::where('customer_id',$id)->get();
        foreach($orders as $order){
            $a = $order->id;
            Order_food::where('order_id',$a)->delete();
            Delivery::where('order_id',$a)->delete();
            $order->delete();
        }
        $customer->delete();

        Session::flash('delete',"Deleted Successfully!");
        return redirect()->route('customers.index');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $a = $request->customer;
        $customers = Customer::where('name','LIKE','%'.$a.'%')
                    ->orWhere('email','LIKE','%'.$a.'%')
                    ->orWhere('id','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('customer.index',compact('customers','order_0'));
        
    }
}
