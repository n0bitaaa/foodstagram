<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery_men;
use App\Delivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Order;

class DeliverymenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $deliveries = Delivery::all();
        $deliverymens=Delivery_men::with('user')->paginate(5);
        return view('deliverymen.index',compact('deliverymens','deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliverymen.create');
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
            'name'=>'required|min:4|max:255',
            'phone'=>'required',
            'email'=>'required',
        ]);
        Delivery_men::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'status'=>0,
            'doa'=>0,
            'user_id'=>Auth::user()->id
        ]);
        Session::flash('success',"Created Successfully");
        return redirect()->route('deliverymens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliverymen = Delivery_men::findOrFail($id);
        return view('deliverymen.show',compact('deliverymen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deliverymen = Delivery_men::findOrFail($id);
        return view('deliverymen.edit',compact('deliverymen'));
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
            'name'=>'required|min:4|max:255',
            'phone'=>'required',
            'email'=>'required',
        ]);
        $deliverymen = Delivery_men::findOrFail($id);
        $deliverymen->name=$request->name;
        $deliverymen->phone=$request->phone;
        $deliverymen->email=$request->email;
        $deliverymen->doa=$request->doa;
        $deliverymen->user_id=Auth::user()->id;
        $deliverymen->save();

        Session::flash('edit',"Edited Successfully");
        return redirect()->route('deliverymens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliverymen = Delivery_men::findOrFail($id);
        $deliverymen->delete();
        Session::flash('delete',"Deleted Successfully");
        return redirect()->route('deliverymens.index');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $a = $request->deliverymen;
        $deliverymens = Delivery_men::where('id','LIKE','%'.$a.'%')
                    ->orWhere('name','LIKE','%'.$a.'%')
                    ->orWhere('phone','LIKE','%'.$a.'%')
                    ->orWhere('email','LIKE','%'.$a.'%')
                    ->orWhere('user_id','LIKE','%'.$a.'%')
                    ->orWhere('status','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('deliverymen.index',compact('deliverymens','order_0'));
        
    }

    public function available($id){
        Delivery_men::where('id',$id)->update(['status'=>'0']);
        Session::flash('available',"Available Now!");
        return redirect()->route('deliverymens.index');
    }

    public function unavailable($id){
        Delivery_men::where('id',$id)->update(['status'=>'1']);
        Session::flash('unavailable',"Unavailable!");
        return redirect()->route('deliverymens.index');
    }
}
