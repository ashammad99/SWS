<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

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
        'name_en',
        'name_ar',
        'email',
        'password',
        'photo',
        'status',
        'gov_id'
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

    protected $dates = ['deleted_at'];

    public function children()
    {
        return $this->hasMany(ChildIdentification::class,'sr_id');
    }
}

