<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereNotIn('name', [''])->get();   //name Admin (Use To display Admin role in role List in website)
        return view('users.roles.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.roles.create_roles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:300|min:3'
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        if ($role) {
            return redirect()->back()->with('success', 'The Role Created Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The Role Created failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('users.roles.edit_roles', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:300|min:3'
        ]);
        $id = $request->id;
        $role = Role::find($id);
        $update = $role->update([
            'name' => $request->name,
        ]);

        if ($update) {
            return redirect()->back()->with('success', 'The Role Updated Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The Role Updated failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        $del = $role->delete();

        if ($del) {
            return redirect()->back()->with('success', 'The Role Deleted Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The Role Deleted failed.');
        }
    }

    public function perimissions_edit($id)
    {
        $role = Role::find($id);
        $perimission = Permission::all();
        return view('users.roles.edit_roles', compact('role', 'perimission'));
    }

    public function perimissions_store(Request $request)
    {
        $role_id = $request->role_id;
        $role = Role::find($role_id);
        $status = $role->syncPermissions($request->permissions);

        if ($status) {
            return redirect()->route('roles.index')->with('success', 'The Permissions Added Successfully To Role.');
        } else {
            return redirect()->back()->with('failed', 'The Permissions Not Added Successfully To Role.');
        }
    }
}
