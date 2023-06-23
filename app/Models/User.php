<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

//default p.k is $id , but when change in db we must define it in model

    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    /*
    protected $fillable = [
        'sr_id',
        'sr_name_en',
        'sr_name_ar',
        'email',
        'password',
    ];
*/
    protected $fillable = [
        'sr_name_en',
        'sr_name_ar',
        'username',
        'email',
        'password',
        'photo',
        'status',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
