<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'code', 'name', 'manufacturer', 'article', 'price', 'img', 'count'];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount(){
        if(!is_null ($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function isAvailable(){
        return $this->count > 0;
    }
    
}
