@extends('template.app')

@section('title', 'Kategori Buku')

@section('content')
{{-- Side Menu --}}
<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-3">kategori Buku</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
            Tambah Kategori
        </button>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $kategori)
                <tr>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->deskripsi ?? 'N/A' }}</td>
                    <td>
                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editKategoriModal" onclick="openEditModal({{ $kategori->id }}, '{{ $kategori->nama }}', '{{ $kategori->deskripsi }}')">
                            <i class="fas fa-edit fa-fw"></i>
                        </button>
                        <!-- Form untuk Hapus Data -->
                        <form id="delete-form-{{ $kategori->id }}" action="{{ route('deleteKategori', ['id' => $kategori->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $kategori->id }})">
                                <i class="fas fa-trash fa-fw"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach


            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambah kategori -->
                <form action="{{ route('createKategori') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="namaKategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="namaKategori" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiKategori" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiKategori" name="deskripsi"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editKategoriForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNamaKategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="editNamaKategori" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsiKategori" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsiKategori" name="deskripsi"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- End Side Menu --}}
@endsection