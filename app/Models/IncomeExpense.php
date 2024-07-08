<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function center(){
        return $this->belongsTo(Center::class)->withDefault();
    }

    public function serviceType(){
        return $this->belongsTo(ServiceType::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function subIncomeExpense(){
        return $this->hasMany(SubIncomeExpense::class);
    }
}
