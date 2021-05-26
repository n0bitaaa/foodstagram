<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Order;
use App\Food;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
    {
        $categories = Category::with('user')->paginate(10);
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'code'=>'required|integer'
        ]);
        $category = new Category;
        $category->id = $request->id;
        $category->name = $request->name;
        $category->code = $request->code;
        $category->user_id =Auth::user()->id;
        $category->save();
        Session::flash('success',"Created Successfully!");
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);
        return view('category.show',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit',compact('category'));
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
            'code'=>'required|integer'
        ]);
        $category =Category::findOrFail($id);
        $category->name = $request->name;
        $category->code = $request->code;
        $category->user_id =Auth::user()->id;
        $category->save();
        Session::flash('edit',"Edited Successfully!");
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Food::where('category_id',$id)->delete();
        Session::flash('delete',"Deleted Successfully!");
        return redirect()->route('categories.index');
    }

    public function search(Request $request){
        $order_0 = Order::where('state',0)->get()->count();
        $a = $request->category;
        $categories = Category::where('name','LIKE','%'.$a.'%')
                    ->orWhere('code','LIKE','%'.$a.'%')
                    ->orWhere('id','LIKE','%'.$a.'%')
                    ->orWhere('user_id','LIKE','%'.$a.'%')
                    ->paginate(10);
        return view('category.index',compact('categories','order_0'));
        
    }
}
