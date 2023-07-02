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

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function children()
    {
        return $this->hasMany(ChildIdentification::class, 'child_id');
    }
    public static function rules()
    {
        return [
            'guardian_fullName_en' => 'required|string',
            'guardian_fullName_ar' => 'required|string',
            'rel_to_en' => 'required|in:FATHER,MOTHER,GRANDFATHER,GRANDMOTHER,BROTHER,SISTER,UNCLE,ANT,FATHER IN LAW,MOTHER IN LAW,SETP-FATHER,STEP-MOTHER,SON,HIM/HERSELF,HER/HIMSELF,AUNT,COUSIN,WIFE',
            'rel_to_ar' => 'required|in:ام,اب,الجد/ة,عم/ة,نفسه/ا,زوج الام,اخ/اخت,الزوج/ة,زوجة الاب,ابن/ابنة عم/خال,ابن/ة,العم/الخال,خالة,نفسه',
            'guardian_id_no' => 'required|integer',
            'guardian_martial_status' => 'required|in:Divorced,Married,Widow',
            'work' => 'required|in:Employee,Jobless,Irregular work',
            'edu_level' => 'required|in:Primary,Preparator,Secondary,Diploma,University,Higher Degree,Vocational,illiterate',
            'monthly_salary' => 'required|in:000-200 GBP,200-500 GBP,More than 500 BGP',
            'child_id' => 'required|exists:child_identification,id',
            'address_details' => 'required|string',
            'governorate_id' => 'required|exists:governorates,id',
            'area_id' => 'required|exists:areas,id',
            'email' => 'required|email',
            'phone_no' => 'nullable|string',
            'mobile_1' => 'required|string',
            'mobile_2' => 'required|string',
        ];
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
