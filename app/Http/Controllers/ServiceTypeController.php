<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\ServiceType;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
     private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = ServiceType::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $keyword = $request->input('keyword');
        $servicetypes = ServiceType::where(function ($query) use ($keyword) {
            $query->where('name', 'ilike', "%" . $keyword . "%");
        })->paginate(10);
        return view('admin.servicetypes.index', compact('servicetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exchangerates = ExchangeRate::all();
        $servicetype = $this->resourceRepository->create($this->model);
        return view('admin.servicetypes.create', compact('servicetype', 'exchangerates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'fee' => 'required|numeric',
            'exchangerate_id' => 'required'
        ]);
        $this->resourceRepository->store($this->model, $data);
        return redirect()->route('servicetypes.index');

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
        $servicetype = $this->resourceRepository->find($this->model, $id);
        $exchangerates = ExchangeRate::all();
        return view('admin.servicetypes.edit', compact('servicetype', 'exchangerates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $data = $request->validate([
            'name' => 'required',
            'fee' => 'required|numeric',
            'exchangerate_id' => 'required'
        ]);
        $this->resourceRepository->update($this->model, $data, $id);
        return redirect()->route('servicetypes.index');
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
