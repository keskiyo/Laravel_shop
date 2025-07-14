<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    {   if(Auth::user()->isAdmin())
        {
            $orders = Order::active()->paginate(10);            
        }else {
            $orders = Auth::user()->orders()->active()->paginate(10);
        }
        return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->orders->contains($order)) {
            return redirect()->route('person.orders.index');
        }

        return view('auth.orders.show', compact('order'));
    }
}
