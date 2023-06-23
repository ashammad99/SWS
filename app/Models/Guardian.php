<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{

//    protected $primaryKey = 'Guardian_id';
    protected $table = 'guardian';
    use HasFactory;


    public function Orphan() {
        return $this->hasMany(Beneficiary::class,'Guardian_id','id');
    }
    public function BankInfo() {
        return $this->hasOne(BankInfo::class,'guardian_id','id');
    }
}
