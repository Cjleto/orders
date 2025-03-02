<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\CreateRole;
use App\Http\Requests\UpdateRole;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {

        $roles = Role::with('permissions')->get();

        return view('roles.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::all()
        ]);
    }

    public function store(CreateRole $request)
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Role $role)
    {


        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function update(UpdateRole $request, Role $role)
    {

        $role->update($request->validated());
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');

    }

    public function destroy(string $id)
    {
        //
    }
}
