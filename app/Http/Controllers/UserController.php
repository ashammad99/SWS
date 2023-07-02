<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed('roles', 'permissions')->get();
        // dd($users->roles);
        return view('users.user.userlist', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $govs = Governorate::all();
        return view('users.user.user_create', compact('roles','govs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'governorate_id' => 'required',
            'email' => 'required|max:250',
            'role' => 'required',
            'password' => 'required|min:8|max:100',
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $photo = 'default.jpg';
        if ($request->has('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('assets/profile'), $photo);
        }
        $status = User::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'gov_id' => $request->governorate_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo,
        ]);
        $status->syncRoles($request->role);
        if ($status) {
            return redirect()->route('users.index')->with('success', 'User Created Successfully.');
        } else {
            return redirect()->back()->with('failed', 'User Not Created Successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_userRole(Request $request, $id)
    {
        //  dd($request->all());

        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $user = User::where('id',$id)->first();
        $photo = $user->photo;
        if ($request->has('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('assets/profile'), $photo);
        }
        if ($request->status == 'on') {
            if ($id == 1) {
                return redirect()->back()->with('failed', 'Admin User Cant Be Disabled.');
            }
            $mode = 0;
        } else {
            $mode = 1;
        }
        if ($request->has('governorate_id')) {
                $user->update(['gov_id'=>$request->governorate_id]);
        }
        $status = $user->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'username' => $request->username,
            'photo' => $photo,
            'status' => $mode,
        ]);
        if ($request->password !== null) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        $user->syncRoles($request->role);
        if ($status) {
            return redirect()->back()->with('success', 'User Updated Successfully.');
        } else {
            return redirect()->back()->with('failed', 'User Not Updated Successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
//        $beneficiaries = Beneficiary::Where('sr_id',Auth::user()->sr_id)->get();
//        return view('profile', compact('user','beneficiaries'));

        return view('profile', compact('user'));
    }


    public function edit_userRole($id)
    {
        /*dd($id);*/
        $roles = Role::all();
        $user = User::where('id', $id)->first();
        // $roleUser = Role::where('id',$user->roles->name)->first();
        $govs = Governorate::all();
        return view('users.user.user_edit', compact('user', 'roles','govs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $request->validate([
            'name_ar' => 'required|string|max:100',
            'name_en' => 'required|string|max:100',
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $user = User::find($id);
        $photo = $user->photo;

        if ($request->has('photo')) {

            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('assets/profile'), $photo);
        }
        if ($request->password !== null) {
            $request->validate([
                'password' => 'min:8|max:15',
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $status = $user->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'photo' => $photo,
        ]);
//        dd($status);
        if ($status) {
            return redirect()->back()->with('success', 'Account Settings has been updated');
        } else {
            return redirect()->back()->with('failed', 'Account Settings not updated');
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
        // dd($request->all());
        $id = $request->id;
        $user = User::find($id);
        $del =  $user->delete();

        if ($del) {
            return redirect()->back()->with('success', 'The User Delete Successfully.');
        } else {
            return redirect()->back()->with('failed', 'The User Delete failed.');
        }
    }
    public function restore($id)
    {
        // Find the trashed user by ID
        $user = User::onlyTrashed()->findOrFail($id);

        // Restore the user
        $user->restore();

        // Redirect back or perform any other actions
        return redirect()->back()->with('success', 'User has been restored successfully.');
    }
    public function getAjax()
    {
        $id = $_POST('id');
       $per = Role::find($id)->first;
       return response()->json([
            'per' => $per,
       ]);
    }
}
