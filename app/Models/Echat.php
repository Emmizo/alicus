<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echat extends Model
{
    use HasFactory;
    protected $fillable = [
        'medical_applied_id',
        'client_pin',
        'staff_id',
        'qty',
        'action',
        'comment',
    ];
    protected $table="echat";
}
