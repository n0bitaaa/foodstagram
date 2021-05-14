<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Food;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Order;
use Stevebauman\Location\Facades\Location;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::with('category')->paginate(10);
        $order_0 = Order::where('state',0)->get()->count();
        return view('food.index',compact('foods','order_0'));
    }

    public function allFood()
    {
        $foods = Food::all();
        $categories = Category::all();
        return view('frontend.shop',compact('foods','categories'));
    }

    public function sortCategory(Request $request)
    {
        $categories = Category::all();
        $category_id = $request->category;
        $foods = Food::where('category_id',$category_id)->get();
        return view('frontend.shop',compact('foods','categories'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $categories = Category::all();
        return view('food.create',compact('categories'));
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
            'food_name'=>'required|min:4|max:255',
            'food_code'=>'required|integer',
            'image'=>'required|mimes:jpeg,png,pdf|max:8192',
            'price'=>'required|integer',
        ]);
        $file = $request->image;
        $extension = $file->extension();
        $uuid = Str::uuid();
        $request->image->storeAs('/public', $uuid.".".$extension);
        $url = Storage::url($uuid.".".$extension);
        Food::create([
            'food_name'=>$request->food_name,
            'food_code'=>$request->food_code,
            'image'=>$url,
            'price'=>$request->price,
            'ingredients'=>$request->ingredients,
            'category_id'=>$request->category_id
        ]);
        Session::flash('success',"Created Successfully");
        return redirect()->route('foods.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foods = Food::findOrFail($id);
        return view('food.show',compact('foods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $food = Food::findOrFail($id);
        return view('food.edit',compact('food','categories'));
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
            'food_name'=>'required|min:4|max:255',
            'food_code'=>'required|integer',
            'image'=>'mimes:jpeg,png,pdf|max:8192',
            'price'=>'required|integer',
        ]);
        $food = Food::findOrFail($id);
        $food->food_name = $request->food_name;
        $food->food_code = $request->food_code;
        if($request['image']){
            $file = $request->image;
            $extension = $file->extension();
            $uuid = Str::uuid();
            $request->image->storeAs('/public', $uuid.".".$extension);
            $url = Storage::url($uuid.".".$extension);
            $food->image = $url;
        }
        $food->price = $request->price;
        $food->ingredients = $request->ingredients;
        $food->category_id = $request->category_id;
        $food->save();
        Session::flash('edit',"Edited Successfully");
        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        Session::flash('delete',"Deleted Successfully!");
        return redirect()->route('foods.index');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $a = $request->food;
        $foods = Food::where('id','LIKE','%'.$a.'%')
                    ->orWhere('food_name','LIKE','%'.$a.'%')
                    ->orWhere('food_code','LIKE','%'.$a.'%')
                    ->orWhere('category_id','LIKE','%'.$a.'%')
                    ->orWhere('price','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('food.index',compact('foods','order_0'));
        
    }
}
