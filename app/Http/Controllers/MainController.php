<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;
use App\Classes\Basket;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSubscriptionMessage;

class MainController extends Controller
{

    public function index(ProductsFilterRequest $request){
        $productQuery = $request->input('search_on_site');
        
        if ($productQuery) {
            $products = Product::where('name', 'LIKE', "%{$productQuery}%")
                ->orWhere('article', 'LIKE', "%{$productQuery}%")
                ->paginate(6)->withPath("?".$request->getQueryString());
        } else {
            $products = Product::paginate(6)->withPath("?" . $request->getQueryString());
        }

        $basket = new Basket();
        $order = $basket->getOrder();
        
        $totalCount = 0;
        if ($order && $order->products) {
            $totalCount = $order->products->sum(function($product) {
                return $product->countInOrder;
            });
        }

        $category = Category::first();
        return view('index', compact('products', 'totalCount', 'category'));
    }

    public function categories()
    {   
        $categories = Category::all();
        
        $basket = new Basket();
        $order = $basket->getOrder();
        
        $totalCount = 0;
        if ($order && $order->products) {
            $totalCount = $order->products->sum(function($product) {
                return $product->countInOrder;
            });
        }

        return view('categories', ['categories' => $categories, 'totalCount' => $totalCount]);
    }

    public function category($code)
    {
        $categoryObject = Category::where('code', $code)->first();
    
        return view('category', ['category' => $categoryObject]);
    }

    public function product($categoryCode, $productArticle) {
        $category = Category::where('code', $categoryCode)->first();
        
        if (!$category) {
            abort(404, 'Категория не найдена');
        }
    
        $product = Product::where('article', $productArticle)
            ->where('category_id', $category->id)
            ->first();
    
        if (!$product) {
            abort(404, 'Товар не найден в указанной категории');
        }
    
        return view('layouts.product', compact('product', 'category'));
    }
    

    public function subscribe(SubscriptionRequest $request, Product $product){

        Subscription::create([
            'email'=> $request->email,
            'product_id'=> $product->id,
        ]);

        try {
            Mail::to($request->email)->send(new SendSubscriptionMessage($product));
            Log::info('Тестовое письмо отправлено на ' . $request->email);
        } catch (\Exception $e) {
            Log::error('Ошибка при отправке тестового письма: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Напоминание оставленно.');
    }
}



