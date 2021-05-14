<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Config;
use Auth;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Cache;
use Illuminate\Support\Facades\Redirect;
use URL;
use Stevebauman\Location\Facades\Location;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    public function showCustomerLoginForm()
    {
        return view('auth.login',['url'=>Config::get('constants.guards.customer')]);
    }

    protected function validator(Request $request){
        return $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
            'image'=>'mimes:png,jpg,jpeg,pdf|max:8192',
        ]);
     }

    public function guardLogin(Request $request,$guard){
        $this->validator($request);
        return Auth::guard($guard)->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ],
        $request->get('remember')
         );
    }

    public function customerLogin(Request $request)
    {
        if($this->guardLogin($request,Config::get('constants.guards.customer'))){

        }
        return back()->withInput($request->only('email','remember'));
    }
     

    // public function customerLogin(Request $request)
    // {
    //     if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

//         return redirect()->intended('/frontend');
    //     }
    //     return back()->withInput($request->only('email', 'remember'));
    // }


    public function showCustomerRegisterForm()
    {
        $location = Location::get('66.102.0.0');
        return view('auth.register',['url'=>Config::get('constants.guards.customer'),'location'=>$location]);
    }
    
    public function guardRegister(Request $request,$guard){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|confirmed|min:8',
            'image'=>'required|mimes:png,jpg,jpeg,pdf|max:8192',
            'location'=>'required'
        ]);
         return Auth::guard($guard)->attempt([
             'email'=>$request->email,
             'password'=>$request->password,
             'image'=>$request->image,
         ],
         $request->get('remember')
         );
     }
 
    public function customerRegister(Request $request)
        {   
            $request->validate([
                'email'=>'required|email',
                'password'=>'required|confirmed|min:8',
                'image'=>'required|mimes:png,jpg,jpeg,pdf|max:8192',
                'location'=>'required|min:8'
            ]);
            $name = $request['name'];
            $email = $request['email'];
            $phone = $request['phone'];
            $password = bcrypt($request['password']);
            $location = $request['location'];
            $file = $request['image'];
            $extension = $file->extension();
            $uuid = Str::uuid();
            $request['image']->storeAs('/public', $uuid.".".$extension);
            $url = Storage::url($uuid.".".$extension);
            $customer = new Customer();
            $customer->email = $email;
            $customer->name = $name;
            $customer->phone = $phone;
            $customer->password = $password;
            $customer->image=$url;
            $customer->location=$location;
            $customer->save();
            $customer->sendEmailVerificationNotification();
            if($this->guardLogin($request,Config::get('constants.guards.customer'))){
                return redirect()->route('order');
        }
        return back()->withInput($request->only('email','remember'));
    }

    public function logout($guard="customer"){
        if(Auth::check()){
            Cache::forget('user-is-online-'. Auth::user()->id,true);
            Auth::logout();
        }
        if (Auth::guard($guard)->check()) {
            Cache::forget('customer-is-online-' . Auth::guard($guard)->id(),true);
            Auth::guard($guard)->logout();
        }
        return redirect()->route('asdf');
    }
}
