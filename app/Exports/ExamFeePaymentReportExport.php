<?php

namespace App\Exports;

use App\Models\ExamFeePayment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamFeePaymentReportExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   protected $data;
    public function __construct(Array $data)
    {
        $this->data = $data;
    }

    public function array() : array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Voucher No',
            'Payment Date',
            'Student Name',
            'Center',
            'Total Fee',
            'Payment Type',
            'Service Type',
            'Exam Date',
            'Bank Name',
            'Remark',


        ];
    }
}
