<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        return view('pages.user.page.shop');
    }
    public function cart()
    {
        return view('pages.user.cart');
    }
    public function checkout()
    {
        return view('pages.user.checkout');
    }
}
