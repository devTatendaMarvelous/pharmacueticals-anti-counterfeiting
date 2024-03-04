<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable=[
        "product_id" ,
        "pharmacy_id" ,
        "buying_price" ,
        "selling_price" ,
        "quantity" ,
        "minimun_order" ,
        "product_description",
        "product_status" ,
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function verificationRequest(){
        return $this->hasOne(VerificationRequest::class,'stock_id');
    }
}
