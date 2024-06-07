<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get("/", function () {
    if (Auth::check()) {
        return redirect("/home");
    }
    return view("auth/login");
});

Auth::routes();

Route::fallback(function () {
    return redirect("/");
});

Route::get("/home", [
    App\Http\Controllers\HomeController::class,
    "index",
])->name("home");

Route::get("/home/category/{id}", [HomeController::class, "filterByCategory"]);
Route::get("/product/{id}", [HomeController::class, "getProductDetails"]);

Route::post("/cart/add", [CartController::class, "addToCart"])->name(
    "cart.add"
);
Route::get("/cart", [CartController::class, "viewCart"])->name("cart");
Route::post("/cart/checkout", [CartController::class, "checkout"])->name(
    "cart.checkout"
);
Route::get("/invoice/{id}", [CartController::class, "generateInvoice"])->name(
    "invoice"
);
