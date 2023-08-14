<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{

    protected $table = 'guardians';
    use HasFactory;

    protected $fillable = [
        'guardian_fullName_en',
        'guardian_fullName_ar',
        'rel_to_en',
        'rel_to_ar',
        'guardian_id_no',
        'guardian_martial_status',
        'work',
        'edu_level',
        'monthly_salary',
        'child_id',
        'address_details',
        'governorate_id',
        'area_id',
        'email',
        'phone_no',
        'mobile_1',
        'mobile_2',
        'child_code',
    ];

    public function child()
    {
        return $this->belongsTo(ChildIdentification::class,'child_id','id');
    }
    public function governorate()
    {
        return $this->hasOne(Governorate::class,'id','governorate_id');
    }

    public function area()
    {
        return $this->hasOne(Area::class,'id','area_id');
    }

/*old code
    public function Orphan() {
        return $this->hasMany(Beneficiary::class,'Guardian_id','id');
    }
    public function BankInfo() {
        return $this->hasOne(BankInfo::class,'guardian_id','id');
    }
*/
}
