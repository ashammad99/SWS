<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('users.permissions.permissions', compact('permissions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.permissions.create_permissions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:300|min:3',
            'note' => 'required|string|max:500|min:3'
        ]);

        $role = Permission::create([
            'name' => $request->name,
            'note' => $request->note,
            // 'guard_name' => 'web',
        ]);

        if ($role) {
            return redirect()->back()->with('success', 'The Perimission Created Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The Perimission Created failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('users.permissions.edit_permissions', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:300|min:3',
            'note' => 'required|string|max:500|min:3'
        ]);
        $id = $request->id;
        $perimission = Permission::find($id);
        $status =  $perimission->update([
            'name' => $request->name,
            'note' => $request->note,
            // 'guard_name' => 'web',
        ]);

        if ($status) {
            return redirect()->route('roles.index')->with('success', 'The Perimission Updated Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The Perimission Updated failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $id = $request->id;
        $perimission = Permission::find($id);
        $del =  $perimission->delete();

        if($del && $request) {
            return redirect()->back()->with('success','The Perimission Deleted Successfully.');
        } else {
            return redirect()->back()->with('failed','The Perimission Deleted failed.');
        }
    }
}
