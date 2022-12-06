<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'topic',
        'group_note',
        'mood',
        'effect',
        'level_participation',
        'comments',
    ];
}
