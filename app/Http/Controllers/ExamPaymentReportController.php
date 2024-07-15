<?php

namespace App\Http\Controllers;

use App\Exports\ExamFeePaymentReportExport;
use App\Models\ExamFeePayment;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExamPaymentReportController extends Controller
{
      private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = ExamFeePayment::class;
    }

    public function index()
    {
         $userCenterId = Auth::user()->center_id;
        $examFeePaymentsQuery = $this->resourceRepository->index($this->model);
        $examfeepayments = $examFeePaymentsQuery->where('center_id', $userCenterId)->paginate(20);
        return view('admin.reports.index', compact('examfeepayments'));
    }

     public function exportExamFeePayments(ExamFeePayment $examfeepayment)
{
    // Fetch data with necessary joins
        $payments = DB::table('exam_fee_payments')
        ->join('centers', 'exam_fee_payments.center_id', '=', 'centers.id')
        ->join('service_types', 'exam_fee_payments.servicetype_id', '=', 'service_types.id')
        ->select(
            'exam_fee_payments.voucher_no as Voucher No.',
            'exam_fee_payments.exam_date as Payment Date',
            'exam_fee_payments.student_name as Student Name',
            'centers.name as Center',
            'exam_fee_payments.total as Total Fee',
            'exam_fee_payments.payment_type as Payment Type',
            'service_types.name as Service Type',
            'exam_fee_payments.exam_date as Exam Date',
            'exam_fee_payments.bank_name as Bank',
            'exam_fee_payments.remark as Remark',
        )
        ->get();
     


    // Convert the collection to an array
    $data = $payments->map(function ($item) {

        return (array) $item;
    })->toArray();

    // Export the data
    return Excel::download(new ExamFeePaymentReportExport($data), 'exam_fee_payment_report.xlsx');
}
}
