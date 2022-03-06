<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $stripe = new \Stripe\StripeClient(
  'sk_test_51HaOdgE6630G1WJDVXB1gruXcdVHSxurBhyG8jFiz976AiV2DLZXyfD1XDAqwifXQ00pru9K1ff7uaj2gzuCk36A002EbB2rds'
);
       $skus= $stripe->products->all();

        return view('list', compact('skus'));
    }
}
