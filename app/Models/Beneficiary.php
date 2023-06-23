<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $table = 'beneficiaries';
    protected $primaryKey = 'NO_ORPHAN_CODE';
    use HasFactory;
    protected $casts = [ 'ORPHAN_DOB'=>'datetime','father_death_date'=>'datetime'];


    public function Guardian() {
        return $this->belongsTo(Guardian::class,'Guardian_id','id');
    }
    public function User() {
        return $this->belongsTo(User::class,'Guardian_id','id');
    }
    public function Governate() {
        return $this->belongsTo(Governorate::class,'gov_id','gov_id');
    }

}
