<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori_buku;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Home extends Controller
{
    // use AuthorizesRequests, ValidatesRequests;
    public function home()
    {
        return view('home_menu');
    }

    public function dashboard()
    {
        if (auth()->check()) {
            if (auth()->user()->role_id != 1) {
                return redirect('/')->with('error', 'Anda tidak memiliki akses');
            }
            $totalAccount = User::count();
            $totalUserLaki = User::where('jenis_kelamin', 'Laki-laki')->count();
            $totalUserPerempuan = User::where('jenis_kelamin', 'perempuan')->count();
            $totalPeminjaman = peminjaman::where('status', 'peminjaman')->count();
            $totalBuku = buku::count();
            $totalKategori = kategori_buku::count();
            $totalPengembalian = peminjaman::where('status', 'pengembalian')->count();
            return view('admin.dashboard', compact(
                'totalAccount',
                'totalUserLaki',
                'totalUserPerempuan',
                'totalPeminjaman',
                'totalBuku',
                'totalKategori',
                'totalPengembalian'
            ));
        }
        return redirect('/login');
    }
}
