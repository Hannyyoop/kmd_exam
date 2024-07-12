<?php

namespace App\Http\Controllers;

use App\Models\SubIncomeExpense;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class SubIncomeExpenseController extends Controller
{
     private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = SubIncomeExpense::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $subincomeexpenses = SubIncomeExpense::where(function ($query) use ($keyword) {
            $query->where('name', 'ilike', "%" . $keyword . "%");

        })->paginate(10);
        return view('admin.subincomeexpense.index', compact('subincomeexpenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subincomeexpense = $this->resourceRepository->create($this->model);
        return view('admin.subincomeexpense.create', compact('subincomeexpense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $this->resourceRepository->store($this->model, $data);
        return redirect()->route('subincomeexpenses.index')->with('success', 'Sub Income Expense created');
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
        $subincomeexpense = $this->resourceRepository->find($this->model, $id);
        return view('admin.subincomeexpense.edit', compact('subincomeexpense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);


        $this->resourceRepository->update($this->model, $data, $id);
        return redirect()->route('subincomeexpenses.index')->with('success', 'Sub Income Expense created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $this->resourceRepository->destroy($this->model, $id);
         return redirect()->back()->with('success', 'Sub Income Expense deleted');


    }
}
