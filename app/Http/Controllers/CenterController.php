<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = Center::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Center::query();

        // Apply search filter if keyword is present
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where("name", "ilike", "%" . $keyword . "%");
                $q->where("code", "ilike", "%" . $keyword . "%");
                $q->where("location", "ilike", "%" . $keyword . "%");
            });
        }
        // Paginate the results
        $centers = $query->paginate(10);

        return view('admin.centers.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $center = $this->resourceRepository->create($this->model);
        return view('admin.centers.create', compact('center'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:centers,name',
            'code' => 'required',
            'location' => 'required'
        ]);
        $data = $request->all();
        $this->resourceRepository->store($this->model, $data);
        return redirect()->route('centers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $center = $this->resourceRepository->find($this->model, $id);
        return view('admin.centers.edit', compact('center'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:centers,name' . $id,
            'code' => 'required',
            'location' => 'required'
        ]);
        $data = $request->all();
        $this->resourceRepository->update($this->model, $data, $id);
        return redirect()->route('centers.index');
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
