<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment_intent_id',
        'status',
        'type',
        'related_transaction_id'
    ];
}
