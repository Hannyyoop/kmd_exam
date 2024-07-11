<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\User;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class UserController extends Controller
{
    private $resourceRepository, $model;
    public function __construct(ResourceRepositoryInterface $resourceRepository){
        $this->resourceRepository = $resourceRepository;
        $this->model = User::class;
    }
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = User::query();

    // Apply search filter if keyword is present
    if ($request->has('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where("name", "ilike", "%" . $keyword . "%")
              ->orWhere("email", "ilike", "%" . $keyword . "%")
              ->orWhere("center_id", "ilike", "%" . $keyword . "%");
        });
    }

    // Order by latest ID
    $query->latest('id');

    // Paginate the results
    $users = $query->paginate(10);


    return view('admin.users.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $user = $this->resourceRepository->create($this->model);

         $centers = Center::all();
        return view('admin.users.create', compact('user','centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{

        $data = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'center_id' => 'required|exists:centers,id',
        ]);

        $data['password'] = Hash::make($request->password);

         $this->resourceRepository->store($this->model, $data);

    return redirect()->route('users.index')->with('success', 'User created successfully');
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
         $user = $this->resourceRepository->find($this->model, $id);
        $centers = Center::all();
        return view('admin.users.edit', compact('user', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $data = $request->validate([
                'center_id' => 'required|exists:centers,id',
                'name' => 'required|unique:users,name,' . $id,
                'email' => 'required|email',
                'password' => 'nullable',
            ]);

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $this->resourceRepository->update($this->model, $data, $id);
             return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $this->resourceRepository->destroy($this->model, $id);
            return redirect()->back();

    }

      public function assignRoleIndex($userId)
    {
        $user = User::findOrFail($userId);
        $roles = ModelsRole::all();
        return view('admin.users.assign-role', compact('user', 'roles'));
    }

    public function assignRole(Request $request){
         $user = User::findOrFail($request->user_id);
        $roleIds = $request->role_ids ?? [];

        if(!$user) {
            session(['error', 'User not found']);
            return redirect()->route('users.index');
        }

        if(empty($roleIds)) {
            $user->roles()->detach();
        } else {
            $roles = ModelsRole::whereIn('id', $roleIds)->get();

            if($roles->count() !== count($roleIds)) {

                session(['error', 'One or more roles were not found']);
                return redirect()->route('users.index');
            }

            $user->syncRoles($roles);
        }

        session(['success', 'Role Successfully Assigned!']);
        return redirect()->route('users.index');
    }


}


