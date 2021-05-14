<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Order;
use Hash;
use Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $users = User::paginate(10);
        $order_0 = Order::where('state',0)->get()->count();
        return view('user.index',compact('users','order_0'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
        ]);
        $file = $request->image;
        $extension = $file->extension();
        $uuid = Str::uuid();
        $request->image->storeAs('/public', $uuid.".".$extension);
        $url = Storage::url($uuid.".".$extension);
        User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request['password']),
            'email'=>$request->email,
            'phone'=>$request->phone,
            'image'=>$url,
        ]);
        Session::flash('success',"Created Successfully!");
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('user.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,User $user)
    {  
        $this->authorize('edit',$user);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $this->authorize('edit',$user);
        $validatedData = $request->validate([
            'name'=>'required|min:4|max:255',
            'image'=>'mimes:jpeg,png,pdf|max:8192',
            'email'=>'required',
            'phone'=>'required',
    ]);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }else{
            $user->password;
        }
        $user->phone=$request->phone;
        if($request->image){
            $file = $request->image;
            $extension = $file->extension();
            $uuid = Str::uuid();
            $request->image->storeAs('/public', $uuid.".".$extension);
            $url = Storage::url($uuid.".".$extension);
            $user->image=$url;
        }
        $user->save();
        Session::flash('edit',"Edited Successfully!");
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('delete',"Deleted Successfully!");
        return redirect()->route('users.index');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $a = $request->user;
        $users = User::where('name','LIKE','%'.$a.'%')
                    ->orWhere('email','LIKE','%'.$a.'%')
                    ->orWhere('id','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('user.index',compact('users','order_0'));
        
    }

}
