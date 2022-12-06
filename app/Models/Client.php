<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'BOD',
        'ssn',
        'insurance_ID',
        'country',
        'address',
        'telephone',
        'email',
        'race',
        'house_hold',
        'ethnicity',
        'gender_birth',
        'martial_status',
        'preferred_language',
        'employment_status',
        'emergency_name',
        'emergency_phone',
        'relationship',
        'emergency_address',
        'primary_care_provider',
        'client_PIN',
        'company_id',
        'created_by',
        'status',
        'is_deleted',
    ];
}
