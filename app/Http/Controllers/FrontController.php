<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){
        $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();
        $user = Auth::user();
        return view('front.index', ['products' => $products , 'categories' => $categories, 'user' => $user]);
    }

    public function details(Product $product){
        return view('front.details', ['product' => $product]);
    }
}
