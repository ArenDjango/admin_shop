<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request, $category_id){
        $category = Category::findOrFail($category_id);
        if(Auth::user()->role == 'admin'){
            $products = Product::where('category_id', $category_id)->get();
        }else{
            $products = Product::where('category_id', $category_id)->where('user_id', auth()->id())->get();
        }

        return view('pages.category', compact('products', 'category'));
    }

    public function addCategory(Request $request)
    {
        Category::create([
           'category_title' => $request->title
        ]);
        return back();
    }

    public function select(Request $request)
    {

        $product = Product::findOrFail($request->id);
        if($product->selected == 1){
            $product->selected = 0;
        }else{
            $product->selected = 1;
        }

        $product->save();
    }
}
