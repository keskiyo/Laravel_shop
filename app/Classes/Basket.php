<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class Basket
{
    protected $order;

    public function __construct($createOrder = false){

        $order = session('order');      

        if (is_null($order) && $createOrder){
            $data = [];
            if(Auth::check()){
                $data['user_id'] = Auth::id();
            }

            $this->order = new Order($data);
            session(['order'=>$this->order]);
        }else {
            $this->order = $order;
        }
    }

    public function countAvailable($updateCount = false){
        if (is_null($this->order) || is_null($this->order->products)) {
            return true;
        }
        
        $products = collect([]);
        foreach($this->order->products as $orderProduct){
            $product = Product::find($orderProduct->id);
            if (!$product) {
                return false;
            }
            
            if($orderProduct->countInOrder > $product->count){
                return false;
            }
            
            if($updateCount){
                $product->count -= $orderProduct->countInOrder;
                $products->push($product);
            }
        }
        
        if($updateCount){
           $products->map->save();
        }

        return true;
    }

    public function getOrder() 
    {
        return $this->order;
    }

    public function saveOrder($name, $phone, $email, $delivery_address, $payment_method, $paymentData = [])
    {
        if (is_null($this->order)) {
            return false;
        }
        
        if(!$this->countAvailable(true))
        {
            return false;
        }
        $this->order->saveOrder($name, $phone, $email, $delivery_address, $payment_method);

        // Сохранить данные об оплате картой
        if (!empty($paymentData) && $this->order->id) {
            $payment = Payment::updateOrCreate(
                ['order_id' => $this->order->id],
                [
                    'user_id' => $this->order->user_id ?? Auth::id(),
                    'card_number' => $paymentData['card_number'] ?? null,
                    'card_expiry' => $paymentData['card_expiry'] ?? null,
                ]
            );
        }

        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
        return true;
    }

    public function removeProduct(Product $product){
        if (is_null($this->order)) {
            return;
        }
        
        if ($this->order->products->contains($product)){
            $pivotRow = $this->order->products->where('id', $product->id)->first();
            if($pivotRow->countInOrder < 2){
                $this->order->products = $this->order->products->filter(function($item) use ($product) {
                    return $item->id != $product->id;
                });
            }else {
                $pivotRow->countInOrder--;
            }            
        }
    }

    public function addProduct(Product $product){
        if (is_null($this->order)) {
            $this->order = new Order();
            $this->order->products = collect();
        }

        if ($this->order->products->contains($product)){
            $pivotRow = $this->order->products->where('id', $product->id)->first();
            if($pivotRow->countInOrder >= $product->count){
                return false;
            }
            $pivotRow->countInOrder++;
        } else {
            if($product->count == 0){
                return false;
            }
            $product->countInOrder = 1;
            $this->order->products->push($product);
        }

        return true;
    }
}
