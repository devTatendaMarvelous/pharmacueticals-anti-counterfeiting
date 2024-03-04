<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_creator',
        'category_name',
        'category_description',
        'category_icon',
    ];
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function stocks(){
        return $this->hasManyThrough(Stock::class,Product::class);
    }
}
