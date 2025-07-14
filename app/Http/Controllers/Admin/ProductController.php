<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $products = Product::get();
        return view('auth.products.form', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $params = $request->all();
        unset($params['img']);
        if($request->has('img')){
            $path = $request->file('img')->store('zap', 'zap_images');
            $params['img'] = 'img/zap/' . $path;
        }
        Product::create($params);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('auth.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $products = Product::get();
        return view('auth.products.form', compact('product', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $params = $request->all();
        unset($params['img']);
        if($request->has('img')){
            Storage::disk('zap_images')->delete(str_replace('img/zap/', '', $product->img));
            $path = $request->file('img')->store('zap', 'zap_images');
            $params['img'] = 'img/zap/' . $path;
        }
        
        $product->update($params);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
