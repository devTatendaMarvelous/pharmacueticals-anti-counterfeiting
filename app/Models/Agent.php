<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'agent_address',
        'tel',
        'cell',
        'agent_description',
        'type_id',
        'agent_type_icon',
        'blockchain_private_key',
        'blockchain_address'
    ];
}
