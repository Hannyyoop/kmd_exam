<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = ExchangeRate::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $exchangerates = ExchangeRate::where(function ($query) use ($keyword) {
            $query->where('code', 'ilike', "%" . $keyword . "%")
                ->orWhere('rate', 'ilike', "%" . $keyword . "%");


        })->paginate(10);
        return view('admin.exchangerates.index', compact('exchangerates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exchangerate = $this->resourceRepository->create($this->model);
        return view('admin.exchangerates.create', compact('exchangerate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $data = $request->validate([
            'code' => 'required',
            'rate' => 'required|numeric'
        ]);


        $this->resourceRepository->store($this->model, $data);
        return redirect()->route('exchangerates.index')->with('success', 'Exchange Rate Successfully created');
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
        $exchangerate = $this->resourceRepository->find($this->model, $id);
        return view('admin.exchangerates.edit', compact('exchangerate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'code' => 'required',
            'rate' => 'required|numeric'
        ]);

        $this->resourceRepository->update($this->model, $data, $id);
        return redirect()->route('exchangerates.index')->with('success', 'Exchange Rate Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->resourceRepository->destroy($this->model, $id);
        return redirect()->back()->with('success', 'Exchange Rate Successfully deleted');
    }
}
