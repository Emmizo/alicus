<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individiual extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'topic',
        'individual_therapy',
        'mood',
        'effect',
        'level_participation',
        'comments',
    ];
    protected $table="individual_notes";
}
