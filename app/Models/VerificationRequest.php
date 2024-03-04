<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    use HasFactory;
    protected $fillable=[
        'stock_id',
        'notes',
        'status'
    ];
    public function stock()
    {
        return $this->belongsTo(Stock::class,'stock_id');

    }
}
