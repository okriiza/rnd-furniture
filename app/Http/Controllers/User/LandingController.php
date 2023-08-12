<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('pages.user.landing');
    }
    public function blog()
    {
        return view('pages.user.page.blog');
    }
    public function contact()
    {
        return view('pages.user.page.contact');
    }
    public function about()
    {
        return view('pages.user.page.about');
    }
    public function service()
    {
        return view('pages.user.page.service');
    }
    public function shop()
    {
        $products = Product::all();
        return view('pages.user.page.shop', compact('products'));
    }
    public function cart()
    {
        $total = 0;
        $cart = Cart::with('product')->get();
        foreach ($cart as $cartProduct) {
            $total += $cartProduct->product->price_product * $cartProduct->quantity;
        }
        return view('pages.user.cart', compact('cart', 'total'));
    }
    public function checkout()
    {
        return view('pages.user.checkout');
    }
}
