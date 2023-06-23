<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;
    protected $primaryKey = 'gov_id';

    public function Benficiary() {
        return $this->hasMany(Governorate::class,'gov_id','gov_id');
    }
}
