<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class UserRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'role_name',
        'created_by_admin',
        'created_by_client',
        'created_at',
        'updated_at',
    ];
    public static function all($columns = ['*'])
    {
        return static::query()->orderby('role_name', 'asc')->get(
            is_array($columns) ? $columns : func_get_args()
        );
    }
}
