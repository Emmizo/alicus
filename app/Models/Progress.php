<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'progress_note',
        'level_participation',
    ];
    protected $table="progress_notes";
}
