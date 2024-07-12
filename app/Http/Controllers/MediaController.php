<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->model = Media::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $medias = Media::where(function ($query) use ($keyword) {
            $query->where('title', 'ilike', "%" . $keyword . "%")
                ->orWhere('code', 'ilike', "%" . $keyword . "%")
                ->orWhere('description', 'ilike', "%" . $keyword . "%");
        })->paginate(10);
        return view('admin.media.index', compact('medias'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $media = $this->resourceRepository->create($this->model);
        return view('admin.media.create', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $data = $request->validate([
        'title' => 'required|unique:media,title|min:5|max:100',
        'description' => 'required|min:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    $data['code'] = rand(10000, 99999);

     if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('medias'), $imageName);

                $data['image'] = $imageName;
            } else {
                $data['image'] = 'No Image Here';
            }
            $this->resourceRepository->store($this->model, $data);

    return redirect()->route('media.index')->with('success', 'Media created successfully.');
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
        $media = $this->resourceRepository->find($this->model, $id);
        return view('admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'title' => 'required|unique:media,title,' . $id . '|min:5|max:100',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);


         $media = Media::findOrFail($id);
            $data['code'] = $media->code;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('medias'), $imageName);
                $data['image'] = $imageName;
            } else {
                $data['image'] = $media->image;
            }
            $this->resourceRepository->update($this->model, $data, $id);


        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $this->resourceRepository->destroy($this->model, $id);
        return redirect()->back()->with('success', 'Media deleted successfully.');
    }
}
