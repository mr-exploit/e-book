@extends('template.app')

@section('title', 'List Buku')

@section('content')
{{-- Side Menu --}}
<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-3">List Buku</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBukuModal">
            Tambah Buku
        </button>
        <table id="ListBuku" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>tahun_terbit</th>
                    <th>Penerbit</th>
                    <th>Jumlah</th>
                    <th>sinopsis</th>
                    <th>img_buku</th>
                    <th>file_buku</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $buku)
                <tr>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->kategori ? $buku->kategori->nama : 'N/A' }}</td>
                    <td>{{ $buku->pengarang }}</td>
                    <td>{{ $buku->tahun_terbit ?? 'N/A' }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->jumlah_halaman ?? 'N/A' }}</td>
                    <td>{{ $buku->sinopsis ?? 'N/A' }}</td>
                    <td>
                        <!-- {{ $buku->img_buku ?? 'N/A' }} -->
                        @if($buku->img_buku)
                        <!-- Button trigger modal -->
                        <a data-bs-toggle="modal" class='text-blue' data-bs-target="#proofModal{{ $buku->id }}">
                            View Buku
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="proofModal{{ $buku->id }}" tabindex="-1" aria-labelledby="proofModalLabel{{ $buku->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="proofModalLabel{{ $buku->id }}">Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/buku/' . $buku->img_buku) }}" alt="Buku " class="img-fluid" width="50%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        'N/A'
                        @endif
                    </td>
                    <td>
                        @if($buku->file_buku)
                        <!-- Button trigger modal -->
                        <a data-bs-toggle="modal" class='text-blue' data-bs-target="#fileModal{{ $buku->id }}">
                            View File Buku
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="fileModal{{ $buku->id }}" tabindex="-1" aria-labelledby="fileModalLabel{{ $buku->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fileModalLabel{{ $buku->id }}">Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <!-- Display the PDF -->
                                        <embed src="{{ asset($buku->file_buku) }}" type="application/pdf" width="100%" height="600px" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        @else
                        'N/A'
                        @endif
                    </td>

                    <td>
                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editBukuModal" onclick="openEditBukuModal({{ $buku->id }}, '{{ $buku->judul }}', '{{ $buku->kategori ? $buku->kategori->nama : N/A }}', '{{ $buku->pengarang }}', '{{ $buku->tahun_terbit }}', '{{ $buku->penerbit }}', '{{ $buku->jumlah_halaman }}',  `{{ addslashes($buku->sinopsis) }}`)">
                            <i class="fas fa-edit fa-fw"></i>
                        </button>



                        <!-- Form untuk Hapus Data -->
                        <form id="delete-form-{{ $buku->id }}" action="{{ route('deleteBuku', ['id' => $buku->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmBukuDelete({{ $buku->id }})">
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

<div class="modal fade" id="addBukuModal" tabindex="-1" aria-labelledby="addBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBukuModalLabel">Tambah Buku Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambah Buku -->
                <form action="{{ route('createBuku') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaBuku" class="form-label">Nama Buku</label>
                        <input type="text" class="form-control" id="namaBuku" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriBuku" class="form-label">Kategori Buku</label>
                        <select class="form-select" id="kategoriBuku" name="kategori_id" required>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pengarangBuku" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarangBuku" name="pengarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahunTerbit" name="tahun_terbit" required min="1900" max="{{ date('Y') }}" value="{{ date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label for="penerbitBuku" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbitBuku" name="penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahBuku" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="jumlahBuku" name="jumlah_halaman" required>
                    </div>
                    <div class="mb-3">
                        <label for="sinopsisBuku" class="form-label">Sinopsis</label>
                        <textarea class="form-control" id="sinopsisBuku" name="sinopsis" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imgBuku" class="form-label">Gambar Buku</label>
                        <input type="file" class="form-control" id="imgBuku" name="img_buku" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="fileBuku" class="form-label">File Buku (PDF only)</label>
                        <input type="file" class="form-control" id="fileBuku" name="file_buku" accept=".pdf" required>
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

<div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="editBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBukuModalLabel">Edit Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBukuForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Same fields as in createBuku -->
                    <div class="mb-3">
                        <label for="editNamaBuku" class="form-label">Nama Buku</label>
                        <input type="text" class="form-control" id="editNamaBuku" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="editKategoriBuku" class="form-label">Kategori Buku</label>
                        <select class="form-select" id="editKategoriBuku" name="kategori_id" required>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPengarangBuku" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="editPengarangBuku" name="pengarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTahunTerbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="editTahunTerbit" name="tahun_terbit" required min="1900" max="{{ date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label for="editPenerbitBuku" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="editPenerbitBuku" name="penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJumlahBuku" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="editJumlahBuku" name="jumlah_halaman" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSinopsisBuku" class="form-label">Sinopsis</label>
                        <textarea class="form-control" id="editSinopsisBuku" name="sinopsis" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imgBuku" class="form-label">Gambar Buku</label>
                        <input type="file" class="form-control" id="imgBuku" name="img_buku" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="fileBuku" class="form-label">File Buku (PDF only)</label>
                        <input type="file" class="form-control" id="fileBuku" name="file_buku" accept=".pdf">
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

@section('script')
<script>
    $(document).ready(function() {
        $('#ListBuku').DataTable();
    });

    /// Buku
    // Function untuk menampilkan modal Delete Buku
    function confirmBukuDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini tidak dapat dikembalikan setelah dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Function untuk menampilkan modal Edit Buku
    function openEditBukuModal(id, judul, kategori, pengarang, tahun_terbit, penerbit, jumlah_halaman, sinopsis) {
        console.log("openEditBukuModal", id, judul, kategori, pengarang, tahun_terbit, penerbit, jumlah_halaman, sinopsis);
        // Set action URL pada form edit
        var formBuku = document.getElementById('editBukuForm');
        formBuku.action = '/list-buku/' + id; // Assuming the route for updating is '/list-buku/{id}'

        // Isi input pada form dengan data yang ada
        document.getElementById('editNamaBuku').value = judul;

        // Set the value for the category select input
        var kategoriSelect = document.getElementById('editKategoriBuku');
        kategoriSelect.value = kategori;

        document.getElementById('editPengarangBuku').value = pengarang;
        document.getElementById('editTahunTerbit').value = tahun_terbit;
        document.getElementById('editPenerbitBuku').value = penerbit;
        document.getElementById('editJumlahBuku').value = jumlah_halaman;
        document.getElementById('editSinopsisBuku').value = sinopsis;

        // Buka modal
        $('#editBukuModal').modal('show');
    }
</script>
@endsection