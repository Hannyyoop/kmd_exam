<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\ExamFeePayment;
use App\Models\ExchangeRate;
use App\Models\ServiceType;
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
    public function index()
    {
        $examFeePaymentsQuery = $this->resourceRepository->index($this->model);
        $examfeepayments = $examFeePaymentsQuery->paginate(20);

        return view('admin.examfeepayments.index', compact('examfeepayments'));
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
        $centers = Center::all();

        // Retrieve all service types with their associated exchange rates
        $servicetypes = ServiceType::with('exchangeRate')->get();

        // Collect the unique currencies from the service types' exchange rates
        $currencies = ExchangeRate::pluck('code')->unique();

        $examfeepayment = $this->resourceRepository->create($this->model);
        return view('admin.examfeepayments.create', compact('centers', 'servicetypes', 'currencies', 'examfeepayment'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'serviceType_id' => 'required|exists:service_types,id',
            'center_id' => 'required|exists:centers,id',
            'exam_date' => 'required|date',
            'student_name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'total_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'refund' => 'required|numeric|min:0',
            'currency' => 'required|string|in:KS,US',
            'payment_type' => 'required|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'remark' => 'required|string|max:255',
        ]);

        // Add additional fields
        $data['user_id'] = Auth::id();
        $data['date'] = now();

        // Retrieve service type and exchange rate
        $servicetype = ServiceType::with('exchangeRate')->findOrFail($data['serviceType_id']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
