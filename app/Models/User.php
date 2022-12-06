<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'role',
        'profile_picture',
        'is_allowed',
        'company_id',
        'employee_id',
        'date_of_birth',
        'created_by',
        'account_verified',
        'delete_feature',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAllUsersAjax($role='') {
        $query = $this->select('*', 'users.id as user_id');
 
        if($role){
             $query->where('users.role', $role);
         }
 
          $query->where('users.role', '!=', 0);
 
          $query->where('users.is_delete', '=', 0);
 
          return $query;
     }

      /**
     * This model function is used to create user
     *
     * @return bool
     * @author Techaffinity:kwizeraa
     */
    public static function createUser($info) {

        return DB::table('users')->insertGetId([
                                 'first_name'=>$info['first_name'],
                                 'last_name'=>$info['last_name'],
                                 'email'=>$info['email'],
                                 'phone_number'=>isset($info['phone_number'])?$info['phone_number']:'',
                                 'profile_picture'=>isset($info['profile_pic'])?$info['profile_pic']:'',
                                 
                                 'employee_id'=>isset($info['employee_id'])?$info['employee_id']:'',
                                 
                                 'company_id'=>isset($info['company_id'])?$info['company_id']:'',
                                 'created_by'=>isset($info['created_by'])?$info['created_by']:'',
                                 'role'=>$info['role'],
                                 'status'=>$info['status'],
                                 'password'=>isset($info['encryptpassword'])?$info['encryptpassword']:Hash::make(rand(54542,55464)),
                                 'created_at'=>date('Y-m-d H:i:s'),
                                 'updated_at'=>date('Y-m-d H:i:s'),
                             ]);
     }
    public static function updateUser($info) {
        $data = [
            'first_name'=>$info['first_name'],
            'last_name'=>$info['last_name'],
            'email'=>$info['email'],
            'phone_number'=>isset($info['phone_number'])?$info['phone_number']:'',
            'profile_picture'=>isset($info['profile_pic'])?$info['profile_pic']:'',
            'company_id'=>isset($info['company_id'])?$info['company_id']:'',
            // 'created_by'=>isset($info['created_by'])?$info['created_by']:'',
            'role'=>$info['role'],
            'status'=>$info['status'],
                ];

        if(isset($info['profile_pic']) && $info['profile_pic']!=''){
            $data['profile_picture'] = $info['profile_pic'];
        }

       return User::where('id', $info['id'])
                    ->update($data);
    }
    public static function updateExistUser($info) {
        $data = [

                    'first_name'=>$info['first_name'],
                    'last_name'=>$info['last_name'],
                    'email'=>$info['email'],
                    'phone_number'=>isset($info['phone_number'])?$info['phone_number']:'',
                    'company_id'=>isset($info['company_id'])?$info['company_id']:'',               
                    'password' => $info['encryptpassword'],
                    'employee_id' => $info['employee_id'],
                    'is_delete' => $info['is_delete'],
                    'role' => $info['role'],
                    
                ];

        if(isset($info['profile_pic']) && $info['profile_pic']!=''){
            $data['profile_picture'] = $info['profile_pic'];
        }

       return User::where('id', $info['id'])
                    ->update($data);
    }
/**
     * This model function is used to delete user
     *
     * @return bool
     * @author Techaffinity:kwizera
     */
    public function deleteUser($id) {
        //$movedtoanothetable = $this->move_one_record($id);
        return $this->where('id', $id)->update(['is_delete'=>1]);
     }
     /**
     * This model function is used to update status place
     *
     * @return bool
     * @author Techaffinity:kwizera
     */
    public function updateStatus($id,$status) {
        return $this->where('id', $id)->update(['status'=>$status]);
     }
}