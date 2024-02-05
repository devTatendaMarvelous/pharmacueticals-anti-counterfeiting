<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'notes',
        'status'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');

    }
}
