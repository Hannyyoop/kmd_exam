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
        //
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
            return view('admin.examfeepayments.create', compact('examfeepayment', 'centers', 'servicetypes', 'currencies'));
        }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request([
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
                'payment_type' => 'required',
                'bank_name' => 'nullable',
                'remark' => 'required',
        ]);
       $data['user_id'] = Auth()->id();
       $data['date']= now();

       $servicetype = ServiceType::with('exchangeRate')->findOrFail($data['serviceType_id']);
       $exchangeRate = $servicetype->exchangeRate->rate;

       $data['exchange_rate'] = $exchangeRate;
        $data['total'] = $data['total_fee'] * $exchangeRate;

        $data['refund'] = $data['payment'] - $data['total'];



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
