<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where("status", 1)->get();
        $products = Product::where("status", 1)->with("category")->get();
        return view("home", compact("categories", "products"));
    }

    public function filterByCategory($id)
    {
        if ($id == 0) {
            $products = Product::where("status", 1)->with("category")->get();
        } else {
            $products = Product::where("status", 1)
                ->where("category_id", $id)
                ->with("category")
                ->get();
        }
        return response()->json($products);
    }

    public function getProductDetails($id)
    {
        $product = Product::with("category")->find($id);
        return response()->json($product);
    }
}
