<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = Auth::id();
        $cartItem = Cart::where("user_id", $userId)
            ->where("product_id", $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                "user_id" => $userId,
                "product_id" => $request->product_id,
                "quantity" => $request->quantity,
            ]);
        }

        return redirect()->route("cart");
    }

    public function viewCart()
    {
        $userId = Auth::id();
        $cartItems = Cart::with("product")->where("user_id", $userId)->get();
        // $this->updateCartCount($userId);
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
        return view("cart", compact("cartItems", "totalPrice"));
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where("user_id", $userId)->with("product")->get();

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;

            // Decrease the product stock
            if ($product->stock >= $cartItem->quantity) {
                $product->stock -= $cartItem->quantity;
                $product->save();
            } else {
                return redirect()
                    ->route("cart")
                    ->with("error", "Not enough stock for " . $product->name);
            }
        }

        // Create an order
        $order = Order::create([
            "user_id" => $userId,
            "total_price" => $cartItems->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->quantity;
            }),
        ]);

        return redirect()
            ->route("invoice", ["id" => $order->id])
            ->with("success", "Checkout successful!");
    }

    public function generateInvoice($id)
    {
        $userId = Auth::id();
        $order = Order::find($id);
        $user = User::find($order->user_id);
        $cartItems = Cart::where("user_id", $order->user_id)
            ->with("product")
            ->get();

        $pdf = PDF::loadView("invoice", compact("order", "user", "cartItems"));
        $pdfPath = storage_path("app/public/invoice_$id.pdf");
        $pdf->save($pdfPath);

        Cart::where("user_id", $userId)->delete();

        return view("invoice_download", [
            "pdfPath" => asset("storage/invoice_$id.pdf"),
        ]);
    }
}
