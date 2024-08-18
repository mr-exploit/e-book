<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori_buku;
use App\Models\log_history;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DatabukuController extends Controller
{
    public function buku()
    {
        $userId = auth()->id();
        $books = buku::all();
        $kategoris = kategori_buku::all();
        foreach ($books as $book) {
            $book->alreadyBorrowed = peminjaman::where('user_id', $userId)
                ->where('buku_id', $book->id)
                ->where('status', ['waiting approve peminjaman', 'peminjaman'])
                ->exists();
        }

        // Mengirim variabel $books ke view 'books.index'
        return view('user.buku', compact('books', 'kategoris'));
    }
    public function createPeminjaman(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        ]);

        $peminjaman = new peminjaman();
        $peminjaman->user_id = auth()->id(); // Assuming the user is authenticated
        $peminjaman->buku_id = $request->buku_id;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->status = 'waiting approve peminjaman';
        $peminjaman->save();

        $history = new log_history();
        $history->peminjaman_id = $peminjaman->id;
        $history->type = 'waiting approve peminjaman';
        $history->status = 'success';
        $history->save();
        return redirect('/buku')->with('success', 'Buku berhasil dipinjam.');
    }


    public function list_buku()
    {
        if (auth()->check()) {
            // Mengambil data kategori buku dari database

            if (auth()->user()->role_id != 1) {
                return redirect('/');
            }
            $books = buku::all();
            $kategoris = kategori_buku::all();

            return view('admin.listbuku', compact('books', 'kategoris'));
        }
        return redirect('/login');
    }

    public function create_buku(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'img_buku' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_buku' => 'required|mimes:pdf|max:10000',
            'tahun_terbit' => 'required',
            'kategori_id' => 'required',
            'jumlah_halaman' => 'required',
            'sinopsis' => 'required',
        ]);

        $buku = new Buku();

        // Handle image upload
        if ($request->hasFile('img_buku')) {
            $image = $request->file('img_buku');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/buku'), $imageName);
            $buku->img_buku = $imageName;
        }

        // Handle PDF upload
        if ($request->hasFile('file_buku')) {
            $fileBuku = $request->file('file_buku');
            $fileName = time() . '_' . $fileBuku->getClientOriginalName();
            $fileBuku->move(public_path('file-buku'), $fileName);
            $buku->file_buku = 'file-buku/' . $fileName;
        }

        // Assign other fields
        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->kategori_id = $request->kategori_id;
        $buku->jumlah_halaman = $request->jumlah_halaman;
        $buku->sinopsis = $request->sinopsis;

        $buku->save();

        return redirect('/list-buku')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function editBuku(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|numeric|min:1900|max:' . date('Y'),
            'penerbit' => 'required',
            'jumlah_halaman' => 'required|numeric',
            'sinopsis' => 'required',
            'img_buku' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_buku' => 'nullable|mimes:pdf|max:10000',
        ]);

        try {
            // Mengambil data buku berdasarkan id
            $buku = Buku::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect('/list-buku')->with('error', 'Buku tidak ditemukan.');
        }

        // Memperbarui data buku dengan data yang divalidasi
        $buku->judul = $validatedData['judul'];
        $buku->kategori_id = $validatedData['kategori_id'];
        $buku->pengarang = $validatedData['pengarang'];
        $buku->tahun_terbit = $validatedData['tahun_terbit'];
        $buku->penerbit = $validatedData['penerbit'];
        $buku->jumlah_halaman = $validatedData['jumlah_halaman'];
        $buku->sinopsis = $validatedData['sinopsis'];

        // Handle img_buku upload
        if ($request->hasFile('img_buku')) {
            // Remove the old image if it exists
            if ($buku->img_buku && file_exists(public_path('storage/buku/' . $buku->img_buku))) {
                unlink(public_path('storage/buku/' . $buku->img_buku));
            }
            $image = $request->file('img_buku');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/buku'), $imageName);
            $buku->img_buku = $imageName;
        }

        // Handle file_buku upload
        if ($request->hasFile('file_buku')) {
            if ($buku->img_buku && file_exists(public_path('file-buku/' . $buku->img_buku))) {
                unlink(public_path('file-buku/' . $buku->img_buku));
            }
            $file = $request->file('file_buku');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file-buku'), $fileName);
            $buku->file_buku = 'file-buku/' . $fileName;
        }

        $buku->save();

        return redirect('/list-buku')->with('success', 'Buku berhasil diperbarui.');
    }


    public function deleteBuku($id)
    {
        $buku = buku::find($id);
        $buku->delete();
        return redirect('/list-buku')->with('success', 'Data Berhasil Dihapus');
    }
}
