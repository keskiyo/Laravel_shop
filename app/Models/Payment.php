<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'card_expiry',
        'card_number',
    ];

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = Crypt::encryptString($value);
    }

    public function getCardNumberAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setCardExpiryAttribute($value)
    {
        $this->attributes['card_expiry'] = Crypt::encryptString($value);
    }

    public function getCardExpiryAttribute($value)
    {
        return Crypt::decryptString($value);
    }

}
