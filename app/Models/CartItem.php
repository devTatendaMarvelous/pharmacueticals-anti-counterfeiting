<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'stock_id',
        'quantity',
    ];
    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id');
    }
}
