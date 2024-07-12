<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function exchangeRate(){
        return $this->belongsTo(ExchangeRate::class, 'exchangerate_id')->withDefault();
    }

    public function examFeePayments(){
        return $this->hasMany(ExamFeePayment::class);
    }

    public function incomeExpenses(){
        return $this->hasMany(IncomeExpense::class);
    }
}
