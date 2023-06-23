<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

    protected $table = 'bank_info';

    public function Guardian() {
        return $this->belongsTo(Guardian::class,'guardian_id','id');
    }
}
