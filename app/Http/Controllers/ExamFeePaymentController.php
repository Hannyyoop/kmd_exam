<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\ExamFeePayment;
use App\Models\ExchangeRate;
use App\Models\ServiceType;
use App\Models\User;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamFeePaymentController extends Controller
{
    private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = ExamFeePayment::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userCenterId = Auth::user()->center_id;
        $examFeePaymentsQuery = $this->resourceRepository->index($this->model);

        // Filter by center_id
        $examFeePaymentsQuery = $examFeePaymentsQuery->where('center_id', $userCenterId);

        // Check if there's a keyword for search
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $examFeePaymentsQuery = $examFeePaymentsQuery->where(function ($query) use ($keyword) {
                $query->where('voucher_no', 'ilike', "%" . $keyword . "%")
                    ->orWhere('student_name', 'ilike', "%" . $keyword . "%")
                    ->orWhere('remark', 'ilike', "%" . $keyword . "%")
                    ->orWhereHas('serviceType', function ($q) use ($keyword) {
                        $q->where('name', 'ilike', "%" . $keyword . "%");
                    });
            });
        }

        // Paginate the results
        $examfeepayments = $examFeePaymentsQuery->paginate(20);

        return view('admin.examfeepayments.index', compact('examfeepayments'));
    }

    public function search(Request $request)
    {
        // Adjust pagination as needed

        return redirect()->route('examfeepayments.search', compact('examfeepayment'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $centers = Center::all();
    //     $servicetypes = ServiceType::all();
    //     $examfeepayment = $this->resourceRepository->create($this->model);
    //     return view('admin.examfeepayments.create', compact('examfeepayment', 'centers', 'servicetypes'));
    // }

    public function create()
    {
        $users = User::all();
        $centers = Center::all();
        $servicetypes = ServiceType::with('exchangeRate')->get();
        $currencies = ExchangeRate::pluck('code')->unique();
        $examfeepayment = $this->resourceRepository->create($this->model);

        return view('admin.examfeepayments.create', compact('users', 'centers', 'servicetypes', 'currencies', 'examfeepayment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // Validate request data
        $data = $request->validate([
            'servicetype_id' => 'required|exists:service_types,id',
            'center_id' => 'required|exists:centers,id',
            'exam_date' => 'required|date',
            'student_name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'total_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'refund' => 'required|numeric|min:0',
            'currency' => 'required',
            'payment_type' => 'required|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
        ]);

        // Add additional fields
        $data['user_id'] = Auth::id();
        $data['date'] = now();

        // Retrieve service type and exchange rate
        $servicetype = ServiceType::with('exchangeRate')->findOrFail($data['servicetype_id']);
        $exchangeRate = $servicetype->exchangeRate->rate;

        // Calculate total and refund
        $data['exchange_rate'] = $exchangeRate;
        $data['total'] = $data['total_fee'] * $exchangeRate;
        $data['refund'] = $data['payment'] - $data['total'];

        // Ensure the currency is set based on the exchange rate's code
        $data['currency'] = $servicetype->exchangeRate->code;

        // Retrieve center and generate voucher number
        $center = Center::findOrFail($data['center_id']);
        $centerCode = $center->code;
        $lastRecord = $this->model::where('center_id', $data['center_id'])->orderBy('id', 'desc')->first();
        $lastVoucherNo = $lastRecord ? intval(str_replace("{$centerCode}-ExamFees-", '', $lastRecord->voucher_no)) : 0;
        $newVoucherNo = $lastVoucherNo + 1;
        $data['voucher_no'] = "{$centerCode}-ExamFees-{$newVoucherNo}";

        // Store the record
        $this->resourceRepository->store($this->model, $data);

        // Redirect with success message
        return redirect()->route('examfeepayments.index')->with('success', 'Record created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $examfeepayment = $this->resourceRepository->find($this->model, $id);
        return view('admin.examfeepayments.print', compact('examfeepayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $centers = Center::all();
        $servicetypes = ServiceType::with('exchangeRate')->get();
        $currencies = ExchangeRate::pluck('code')->unique();
        $examfeepayment = $this->resourceRepository->find($this->model, $id);

        return view('admin.examfeepayments.edit', compact('users', 'centers', 'servicetypes', 'currencies', 'examfeepayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'servicetype_id' => 'required|exists:service_types,id',
            'center_id' => 'required|exists:centers,id',
            'exam_date' => 'required|date',
            'student_name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'total_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'refund' => 'required|numeric|min:0',
            'currency' => 'required',
            'payment_type' => 'required|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
        ]);
        // Retrieve the existing record by ID
        $examfeepayment = ExamFeePayment::findOrFail($id);

        // Retrieve service type and exchange rate
        $servicetype = ServiceType::with('exchangeRate')->findOrFail($data['servicetype_id']);
        $exchangeRate = $servicetype->exchangeRate->rate;

        // Calculate total and refund
        $data['exchange_rate'] = $exchangeRate;
        $data['total'] = $data['total_fee'] * $exchangeRate;
        $data['refund'] = $data['payment'] - $data['total'];

        // Ensure the currency is set based on the exchange rate's code
        $data['currency'] = $servicetype->exchangeRate->code;

        // Update the existing record
        $this->resourceRepository->update($this->model, $data, $id);

        // Redirect with success message
        return redirect()->route('examfeepayments.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->resourceRepository->destroy($this->model, $id);
        return redirect()->back();
    }
}
