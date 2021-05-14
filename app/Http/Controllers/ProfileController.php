<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Hash;


class ProfileController extends Controller
{
    public function index(){
        return view('frontend.profile');
    }

    public function updatePic(Request $request,$id){
        $file = $request->image;
        $extension = $file->extension();
        $uuid = Str::uuid();
        $request->image->storeAs('/public', $uuid.".".$extension);
        $url = Storage::url($uuid.".".$extension);
        $customer = Customer::findOrFail($id);
        $customer->image = $url;
        $customer->save();
        Session::flash('success',"Updated Successfully!");
        return redirect()->route('profile');
    }

    public function updateDetail(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'location'=>'required|min:6'
        ]);
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->location = $request->location;
        $customer->save();
        Session::flash('success',"Updated Successfully!");
        return redirect()->route('profile');
    }

    public function updatePass(Request $request,$id){
        $request->validate([
            'cpassword'=>'required',
            'password'=>'required|min:8'
        ]);
        $customer = Customer::findOrFail($id);
        if(Hash::check($request->cpassword,$customer->password)){
            $customer->password = bcrypt($request->password);
            $customer->save();
            Session::flash('success_pwd',"Password Change Successfully!");
            return redirect()->route('profile');
        }else{
            Session::flash('fail_pwd',"Your current password is wrong!");
            return redirect()->route('profile');
        }
    }
}
