<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sales = Sale::with('product')->latest()->get(); 
        return view('admin.product.sale.index', compact('sales', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0', 
            'paid' => 'required|numeric|min:0', 
        ]);

        DB::beginTransaction();
        try {
            $productInfo = Product::findOrFail($request->product_id);
            $qty = $request->qty;
            $discountAmount = $request->discount ?? 0;
            $saleUnitPrice = $productInfo->p_s_price;

            $subTotal = $saleUnitPrice * $qty - $discountAmount;
            $vatAmount = $subTotal * 0.05; // Assuming 5% VAT
            $totalAmount = $subTotal + $vatAmount;
            $dueAmount = $totalAmount - $request->paid;

            if ($productInfo->p_stock < $qty) {
                toastr()->error('Insufficient stock for this product.');
                return back();
            }

            $productInfo->decrement('p_stock', $qty);

            $sale = Sale::create([
                'product_id' => $request->product_id,
                'qty' => $qty,
                'discount' => $discountAmount,
                'vat' => $vatAmount,
                't_amount' => $totalAmount,
                'paid' => $request->paid,
                'due' => $dueAmount,
            ]);

            DB::commit();
            toastr()->success('Sale created successfully.');
            return redirect(route('products.sales.sale.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something went wrong while creating the sale.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
