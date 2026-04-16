<?php
namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    // ======================
    // LIST ADMIN (TIDAK TERMASUK YANG LOGIN)
    // ======================
    public function index()
    {
        $users = User::where('role', 'admin')
            ->where('id', '!=', Auth::id()) // ⬅️ exclude diri sendiri
            ->get();

        return view('adm.user.useradm', compact('users'));
    }

    // ======================
    // LIST STAFF
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
    // STORE
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/users/admin')->with('success', 'User berhasil ditambahkan');
    }

    // ======================
    // FORM EDIT
    // ======================
    public function edit($id)
    {
        // ⛔ cegah edit diri sendiri lewat halaman admin (optional tapi bagus)
        if ($id == Auth::id()) {
            return redirect('/users/admin')->with('error', 'Tidak bisa edit diri sendiri di sini');
        }

        $user = User::findOrFail($id);
        return view('adm.user.useredit', compact('user'));
    }

    // ======================
    // UPDATE USER
    // ======================
    public function update(Request $request, $id)
    {
        // ⛔ cegah update diri sendiri lewat menu admin
        if ($id == Auth::id()) {
            return redirect('/users/admin')->with('error', 'Tidak bisa update diri sendiri di sini');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required',
            'password' => 'nullable|min:6',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect('/users/admin')->with('success', 'User berhasil diupdate');
    }

    // ======================
    // DELETE
    // ======================
    public function delete($id)
    {
        // ⛔ cegah hapus diri sendiri
        if ($id == Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    // ======================
    // EDIT PROFILE (USER LOGIN)
    // ======================
    public function editProfile()
    {
        $user = Auth::user();
        return view('stff.profile.edit', compact('user'));
    }

    // ======================
    // UPDATE PROFILE
    // ======================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect('/profile/edit')->with('success', 'Profile berhasil diupdate');
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
