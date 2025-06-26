<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

        return view('admin.product.index', compact('products'));
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
            'p_name' => 'required|string|max:150',
            'p_p_price' => 'required|numeric|min:0',
            'p_s_price' => 'required|numeric|min:0',
            'p_stock' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            Product::create($data);
            DB::commit();
            toastr()->success('Product created successfully');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something went wrong while creating the product');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'p_name' => 'required|string|max:150',
            'p_p_price' => 'required|numeric|min:0',
            'p_s_price' => 'required|numeric|min:0',
            'p_stock' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            $product->update($data);
            DB::commit();
            toastr()->success('Product updated successfully');
            return redirect(route('products.product.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Something went wrong while updating the product');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            toastr()->warning('Product deleted successfully');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong while deleting the product');
            return back();
        }
    }
}
