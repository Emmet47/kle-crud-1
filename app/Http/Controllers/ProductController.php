<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(1);
        return view("product.index", [
            "products"=> $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("product.create",);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric|min:0',
        'description' => 'required|string|max:255',
    ]);

    Product::create([
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'description' => $request->description
    ]);

    return redirect('/product')->with('status', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);
        $product->update([
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'description' => $request->description]);
        return redirect('/product')->with('status','Product Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
return redirect('/product')->with('status','Category Deleted Succesfully');
    }
}
