<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back();
        }

        $addToCart = Cart::create([
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
        if ($addToCart) {
            return redirect()->route('cart')->with('success', 'Product added to cart');
        }
    }
    public function plus($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $cart->quantity + 1;
        $cart->save();
        return redirect()->back();
    }
    public function minus($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back();
        }
        $cart = Cart::findOrFail($id);
        $cart->quantity = $cart->quantity - 1;
        $cart->save();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $cart = Cart::with('product')->where('user_id', 1)->get();
        $transaction = Transaction::create([
            'user_id' => 1,
            'invoice' => 'INV-' . date('YmdHis'),
            'transaction_total' => 0,
            'transaction_status' => 'pending',
        ]);

        foreach ($cart as $cartProduct) {
            $transaction->products()->attach($cartProduct->product_id);
            $transaction->increment('transaction_total', $cartProduct->product->price_product * $cartProduct->quantity);
            Product::find($cartProduct->product_id)->decrement('stock_product', $cartProduct->quantity);
        }

        $transactionDetials = [
            'order_id' => $transaction->id . '-' . Str::random(5),
            'gross_amount' => $transaction->transaction_total,
        ];

        $itemDetails = [];
        foreach ($cart as $cartProduct) {
            $itemDetails[] = [
                'id' => $cartProduct->product->id,
                'price' => $cartProduct->product->price_product,
                'quantity' => $cartProduct->quantity,
                'name' => $cartProduct->product->name_product,
            ];
        }

        $customerDetails = [
            'first_name' => 'Rendi Okriza',
            'email' => 'okriizaa@gmail.com',
            'phone' => "089502161899"
        ];
        $midtransParams = [
            'transaction_details' => $transactionDetials,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];
        $midtransSnapUrl = $this->getMidtransSnapUrl($midtransParams);

        $transaction->snap_url = $midtransSnapUrl;
        $transaction->save();

        return redirect($transaction->snap_url);
        // return redirect()->route('home')->with('success', 'Transaction success');
    }
    private function getMidtransSnapUrl($params)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_PRODUCTION');
        \Midtrans\Config::$isSanitized = (bool) env('MIDTRANS_SANITIZED');
        \Midtrans\Config::$is3ds = (bool) env('MIDTRANS_3DS');

        $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
        return $snapUrl;
    }
}
