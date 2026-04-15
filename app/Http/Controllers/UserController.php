<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ======================
    // LIST ADMIN
    // ======================
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('adm.user.useradm', compact('users'));
    }

    // ======================
    // LIST STAFF / OPERATOR
    // ======================
    public function staff()
    {
        $users = User::where('role', 'staff')->get();
        return view('adm.user.userstf', compact('users'));
    }

    // ======================
    // FORM CREATE
    // ======================
    public function create()
    {
        return view('adm.user.usercreate');
    }

    // ======================
    // STORE DATA
    // ======================
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/users/admin');
    }

    // ======================
    // FORM EDIT USER (ADMIN)
    // ======================
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('adm.user.useredit', compact('user'));
    }

    // ======================
    // UPDATE USER (ADMIN)
    // ======================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // update password kalau diisi
        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect('/users/admin');
    }

    // ======================
    // DELETE USER
    // ======================
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }

    // ======================
    // FORM EDIT PROFILE (USER LOGIN)
    // ======================
    public function editProfile()
    {
        $user = auth::user();
        return view('stff.profile.edit', compact('user'));
    }

    // ======================
    // UPDATE PROFILE
    // ======================
    public function updateProfile(Request $request)
    {
        $user = auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // update password kalau diisi
        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect('/profile/edit')->with('success', 'Profile berhasil diupdate');
    }
}