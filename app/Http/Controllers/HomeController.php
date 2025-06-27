<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
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
        $totalSale = Sale::sum('t_amount');
        $totalProduct = Product::sum('p_stock');
        $totalDiscount = Sale::sum('discount');
        $totalDue = Sale::sum('due');
        return view('home', compact('totalSale', 'totalProduct','totalDiscount','totalDue'));
    }
}
