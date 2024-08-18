<?php

namespace App\Http\Controllers;

use App\Models\kategori_buku;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        if (auth()->check()) {
            // Mengambil data kategori buku dari database

            if (auth()->user()->role_id != 1) {
                return redirect('/');
            }
            $users = User::select('id', 'nama', 'email', 'jenis_kelamin', 'agama', 'TTL', 'no_hp', 'alamat', 'status', 'created_at')->get();

            return view('admin.userlist', compact('users'));
        }

        return redirect('/login');
    }

    public function UserId($id)
    {
        // Mengambil data kategori buku berdasarkan id
        $user = User::find($id);

        if (!$user) {
            return redirect('/admin/userlist')->with('error', 'No user record found.');
        }

        return view('admin.userlist', compact('user'));
    }

    public function editUser(Request $request, $id)
    {
        // Validasi input
        $validatedata = $request->validate([
            'status' => 'required',
        ]);

        try {
            // Mengambil data kategori buku berdasarkan id
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect('/admin/userlist')->with('error', 'No user record found.');
        }

        // Memperbarui data user dengan data yang divalidasi
        if ($validatedata['status'] == 'Active') {
            $validatedata['status'] = 1;
        } else {
            $validatedata['status'] = 0;
        }
        $user->status = $validatedata['status'];
        $user->save();

        return redirect('/admin/userlist')->with('success', 'user updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('/admin/userlist')->with('error', 'No user record found.');
        }

        $user->delete();

        return redirect('/admin/userlist')->with('success', 'user deleted successfully');
    }

    public function userProfile()
    {
        if (auth()->check()) {
            if (auth()->user()->role_id != 2) {
                return redirect('/')->with('error', 'Anda tidak memiliki akses');
            }

            $userData = auth()->user();
            $user = [
                'name' => $userData->nama,
                'email' => $userData->email,
                'jenis_kelamin' => $userData->jenis_kelamin,
                'agama' => $userData->agama,
                'no_hp' => $userData->no_hp,
                'alamat' => $userData->alamat,
                'created_at' => $userData->created_at,
            ];

            // Tidak perlu cek !$user karena $user tidak akan kosong
            return view('user.profile', compact('user'));
        }
        return redirect('/login');
    }
}
