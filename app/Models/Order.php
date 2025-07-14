<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sum', 'email', 'delivery_address', 'payment_method'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count', 'price')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullPrice(){
        $sum = 0;
        foreach ($this->products as $product){
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }
 
    public function getFullPrice(){

        $sum = 0;
        
        foreach($this->products as $product)
        {
            $sum += $product->price * $product->countInOrder;
        }

        return $sum;
    }
    
    public function saveOrder($name, $phone, $email, $delivery_address, $payment_method){
        
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->email = $email;
        $this->sum = $this->getFullPrice();
        $this->delivery_address = $delivery_address;
        $this->payment_method = $payment_method;

        $products = $this->products;
        $this->save();

        foreach($products as $productInOrder){
            $this->products()->attach($productInOrder, [
                'count'=>$productInOrder->countInOrder,
                'price'=>$productInOrder->price,
            ]);
        }
        session()->forget('order');
        return true;
    }
}
