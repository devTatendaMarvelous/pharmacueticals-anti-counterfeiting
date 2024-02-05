<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'home_address',
        'office_address',
        'client_phone',
    ];
}
