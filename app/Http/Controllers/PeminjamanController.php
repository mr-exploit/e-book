<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\log_history;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    public function peminjaman(Request $request)
    {
        // dd(auth()->user()->role_id);
        if (auth()->check()) {
            if (auth()->user()->role_id != 2) {
                return redirect('/buku')->with('error', 'Anda tidak memiliki akses');
            }
            $userId = auth()->id();
            $peminjamans = peminjaman::where('user_id', $userId)->whereIn('status', ['waiting approve peminjaman', 'peminjaman'])->get();
            foreach ($peminjamans as $peminjaman) {
                $peminjaman->buku = buku::find($peminjaman->buku_id);
            }

            return view('user.peminjaman', compact('peminjamans'));
        }
        return redirect('/login');
    }

    public function pengembalianBuku(Request $request, $id)
    {
        if (auth()->user()->role_id != 2) {
            return redirect('/buku')->with('error', 'Anda tidak memiliki akses');
        }
        $peminjaman = peminjaman::find($id);

        if (!$peminjaman) {
            return redirect('/buku/peminjaman')->with('error', 'peminjaman tidak ditemukan');
        }
        // dd($peminjaman);

        $peminjaman->status = 'pengembalian';
        $peminjaman->save();
        $history = new log_history();
        $history->peminjaman_id = $peminjaman->id;
        $history->type = 'pengembalian';
        $history->status = 'success';

        $history->save();

        return redirect('/buku/peminjaman')->with('success', 'Buku Berhasil DiBalikkan');
    }

    public function pengembalian(Request $request)
    {
        // dd(auth()->user()->role_id);
        if (auth()->check()) {
            if (auth()->user()->role_id != 2) {
                return redirect('/buku')->with('error', 'Anda tidak memiliki akses');
            }
            $userId = auth()->id();
            $pengembalians = peminjaman::where('user_id', $userId)->where('status', 'pengembalian')->get();
            foreach ($pengembalians as $pengembalian) {
                $pengembalian->buku = buku::find($pengembalian->buku_id);
            }

            return view('user.pengembalian', compact('pengembalians'));
        }
        return redirect('/login');
    }

    public function logPengembalian(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id != 1) {
                return redirect('/')->with('error', 'Anda tidak memiliki akses');
            }

            // Mengambil semua log pengembalian yang memiliki tipe 'pengembalian'
            $pengembalians = log_history::where('type', 'pengembalian')->get();

            foreach ($pengembalians as $pengembalian) {
                // Ambil data peminjaman berdasarkan peminjaman_id di log_history
                $peminjaman = peminjaman::with('user', 'buku.kategori')
                    ->find($pengembalian->peminjaman_id);

                if ($peminjaman) {
                    // Menambahkan data buku dan tanggal pengembalian ke objek pengembalian
                    $pengembalian->buku = $peminjaman->buku;
                    $pengembalian->tanggal_pengembalian = $peminjaman->tanggal_pengembalian;
                    $pengembalian->user = $peminjaman->user;
                    $pengembalian->status = $peminjaman->status;
                } else {
                    // Jika peminjaman tidak ditemukan, set default values
                    $pengembalian->buku = null;
                    $pengembalian->tanggal_pengembalian = null;
                    $pengembalian->user = null;
                    $pengembalian->status = null;
                }
            }

            return view('admin.logpengembalian', compact('pengembalians'));
        }

        return redirect('/login');
    }

    public function logPeminjaman(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id != 1) {
                return redirect('/')->with('error', 'Anda tidak memiliki akses');
            }

            // Mengambil semua log peminjaman yang memiliki tipe 'peminjaman'
            $logPeminjamans = log_history::where('type', 'peminjaman')->get();

            $peminjamans = [];

            foreach ($logPeminjamans as $logPeminjaman) {
                // Ambil data peminjaman berdasarkan peminjaman_id di log_history
                $peminjaman = peminjaman::with('user', 'buku.kategori')
                    ->find($logPeminjaman->peminjaman_id);

                if ($peminjaman) {
                    // Menambahkan data buku ke dalam objek peminjaman
                    $peminjamans[] = $peminjaman;
                }
            }

            return view('admin.logpeminjaman', compact('peminjamans'));
        }

        return redirect('/login');
    }

    public function list_Peminjaman(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id != 1) {
                return redirect('/')->with('error', 'Anda tidak memiliki akses');
            }

            $userId = auth()->id();
            // Ambil data peminjaman dengan status 'waiting approve peminjaman' atau 'peminjaman'
            $peminjamans = peminjaman::whereIn('status', ['waiting approve peminjaman', 'peminjaman'])
                ->get();
            // dd($peminjamans);
            // Debug: Periksa apakah ada data peminjaman yang ditemukan
            if ($peminjamans->isEmpty()) {
                return view('admin.listpeminjaman')->with('error', 'Tidak ada data peminjaman ditemukan.');
            }

            // Load data buku untuk setiap peminjaman
            foreach ($peminjamans as $peminjaman) {
                $peminjaman->buku = buku::find($peminjaman->buku_id);
                if (!$peminjaman->buku) {
                    return view('admin.listpeminjaman')->with('error', 'Data buku tidak ditemukan untuk peminjaman.');
                }
            }

            // Kirim variabel ke view
            return view('admin.listpeminjaman', compact('peminjamans'));
        }
        return redirect('/login');
    }



    public function PeminjamanStatus(Request $request, $id)
    {
        if (auth()->user()->role_id != 1) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses');
        }

        $peminjaman = peminjaman::find($id);

        if (!$peminjaman) {
            return redirect('/buku/peminjaman')->with('error', 'Peminjaman tidak ditemukan');
        }

        $status = $request->input('status'); // Mengambil status dari request
        $peminjaman->status = $status;
        $peminjaman->save();

        $history = new log_history();
        $history->peminjaman_id = $peminjaman->id;
        $history->type = $status;
        $history->status = 'success';
        $history->save();

        return redirect('/list-peminjaman')->with('success', 'Status peminjaman berhasil diperbarui');
    }
}
