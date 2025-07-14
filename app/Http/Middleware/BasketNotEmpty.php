<?php

namespace App\Http\Middleware;

use Closure;

class BasketNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order = session('order');

        if (!is_null($order) && $order->getFullPrice() > 0) {
            return $next($request);
        }
        
        session()->forget('order');
        session()->flash('warning', 'Ваша корзина пустая');
        return redirect()->route('categories');
    }
}