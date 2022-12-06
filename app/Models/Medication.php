<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
    protected $fillable = [
        'medication_name',
        'dose_units',
        'dose_quantity',
        'frequency',
        'prescriber',
        'date_start',
        'created_by',
        'client_id',
    ];
}
