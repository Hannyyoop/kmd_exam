<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Role::query();

        // Apply search filter if keyword is present
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where("name", "ilike", "%" . $keyword . "%");
            });
        }

        // Order by latest ID
        $query->latest('id');

        // Paginate the results
        $roles = $query->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::create(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully');
    }

    public function assignPermissionIndex(string $id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        return view('admin.roles.assign-permission', compact('permissions', 'role'));
    }

    public function assignPermission(Request $request)
    {

        $role = Role::findOrFail($request->role_id);

        if (empty($request->permission_ids)) {
            $role->syncPermissions([]);

            session(['error', 'No Permission Assign to the role']);
            return redirect()->route('roles.index');
        }

        $permissions = Permission::whereIn('id', $request->permission_ids)->get();

        if ($permissions->count() !== count($request->permission_ids)) {

            session(['error', 'One or more permissions were not found']);
            return redirect()->route('roles.index');
        }

        $role->syncPermissions($permissions);
        session(['success', 'Permission assigned successfully']);
        return redirect()->route('roles.index');
    }
}
