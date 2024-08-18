<?php

namespace App\Http\Controllers;

use App\Models\kategori_buku;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class KategoriController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    public function kategori()
    {
        if (auth()->check()) {
            // Mengambil data kategori buku dari database

            if (auth()->user()->role_id != 1) {
                return redirect('/');
            }
            $kategoris = kategori_buku::all();

            return view('admin.kategori_buku', compact('kategoris'));
        }

        return redirect('/login');
    }


    public function createKategori(Request $request)
    {
        // Validasi input
        $validateData = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        // Membuat instance baru dari kategori_buku
        $kategori = new kategori_buku([
            'nama' => $validateData['nama'],
            'deskripsi' => $validateData['deskripsi'],
        ]);

        // Menyimpan kategori ke dalam database
        if ($kategori->save()) {
            return redirect('/kategori')->with('success', 'Kategori Buku Berhasil Ditambahkan');
        } else {
            return redirect('/kategori')->with('error', 'Kategori Buku Gagal Ditambahkan');
        }
    }

    public function kategoriId($id)
    {
        // Mengambil data kategori buku berdasarkan id
        $kategoris = kategori_buku::find($id);

        if (!$kategoris) {
            return redirect('/kategori')->with('error', 'No kategori record found.');
        }

        return view('admin.kategori_buku', compact('kategoris'));
    }

    public function editKategori(Request $request, $id)
    {
        // Validasi input
        $validatedata = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        try {
            // Mengambil data kategori buku berdasarkan id
            $kategori = kategori_buku::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect('/kategori')->with('error', 'No kategori record found.');
        }

        // Memperbarui data kategori dengan data yang divalidasi
        $kategori->nama = $validatedata['nama'];
        $kategori->deskripsi = $validatedata['deskripsi'];
        $kategori->save();

        return redirect('/kategori')->with('success', 'Kategori updated successfully');
    }

    public function deleteKategori($id)
    {
        $kategori = kategori_buku::find($id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'No kategori record found.');
        }

        $kategori->delete();

        return redirect('/kategori')->with('success', 'Kategori deleted successfully');
    }
}
