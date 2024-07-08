<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function examFeePayments(){
        return $this->hasMany(ExamFeePayment::class);
    }

    public function incomeExpenses(){
        return $this->hasMany(IncomeExpense::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
