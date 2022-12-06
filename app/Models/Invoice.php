<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'start_date',
        'billing_date',
        'price_per_day',
        'no_of_day',
        'staff_id',
        'tot',
        'payment',
        'due_payment',
    ];
}
