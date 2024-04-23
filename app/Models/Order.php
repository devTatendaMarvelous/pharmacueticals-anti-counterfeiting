<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'delivery',
        'payment_method',
        'delivery_date',
        'is_future',
        'currency',
        'order_amount',
        'account_number',
        'status',
        'order_number',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
