<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Classes\Basket;
use Auth;

class BasketController extends Controller
{
    public function confirm(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'card_number' => 'required_if:paymentMethod,card|nullable|digits:16',
            'card_expiry' => 'required_if:paymentMethod,card|nullable|regex:/^\d{2}\/\d{2}$/',
            'delivery_address' => 'required_if:delivery_type,delivery',
        ]);
    }

    public function basketConfirm(Request $request){

        $email = Auth::check() ? Auth::user()->email : $request->email;
        $paymentData = $request->input('payment', []);
        $delivery_address = $request->input('delivery_address', null);
        $payment_method = $request->input('paymentMethod');

        if((new Basket())->saveOrder($request->name, $request->phone, $email, $delivery_address, $payment_method, $paymentData)){
            session()->flash('success','Ваш заказ принят в обработку !');
        }else{
            session()->flash('warning', 'Товара в таком количестве не доступен ');
        }

        return redirect()->route('categories');
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();  
        if(!$basket->countAvailable()){
            session()->flash('warning', 'Товара в таком количестве не доступен ');
            return redirect()->route('basket');
        }

        return view('order', compact('order'));
    }

    public function basket()
    {
        $basket = new Basket(true);
        $order = $basket->getOrder();

        return view('basket', compact('order'));
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);
        
        if($result){
            session()->flash('success', 'Добавлен товар: '.$product->name);
        } else{
            session()->flash('warning', 'Такого товара больше нет: '.$product->name);
        }
        
        return redirect()->route('basket');

    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);

        session()->flash('warning', 'Удален товар: '.$product->name);

        return redirect()->route('basket');
    }

}
