<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "manufacturer_id",
        "product_name",
        "category_id",
        "buying_price",
        "selling_price",
        "quantity",
        "product_description",
        "product_photo",
        "is_published",
        "minimun_order",
        "serial",
    "verification_token",
        "is_verified"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'pharmacy_id');
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class,'manufacturer_id');
    }
    public function stocks(){
        return $this->hasMany(Stock::class,'product_id');
    }
}
