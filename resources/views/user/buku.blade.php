@extends('layouts.app')

@section('title', 'Data buku')

@section('content')
{{-- Side Menu --}}

<div class="container mt-5 p-5">
    <div class="row">
        <h1>Daftar buku</h1>
        @foreach($books as $buku)
        <div class="col-md-4 mb-3 mt-5">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('storage/buku/' . $buku->img_buku) }}" alt="Buku " class="img-fluid" width="50%" height="200px">
                <div class="card-body">
                    <span class="badge bg-warning mb-3 mt-3">{{$buku->kategori ? $buku->kategori->nama : 'N/A'}}</span>
                    <h5 class="card-title">{{$buku->judul}}</h5>
                    <p class="card-text">Tahun Terbit :{{$buku->tahun_terbit}}</p>
                    <p class="card-sinopsis">Jumlah Halaman: {{$buku->jumlah_halaman}}</p>
                    <p class="card-sinopsis">Sipnosis:<br> {{$buku->sinopsis}}</p>
                    @if(auth()->check())
                    @if($buku->alreadyBorrowed)
                    <button type="button" class="btn btn-secondary" disabled>Buku Sudah Dipinjam</button>
                    @else
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#peminjamanModal"
                        onclick="openPeminjamanModal({{ $buku->id }}, '{{ $buku->judul }}')">
                        Pinjam Buku
                    </button>
                    @endif
                    @else
                    <a href="{{ url('login') }}" class="btn btn-primary">
                        Pinjam Buku
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="peminjamanModalLabel">Pinjam Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="peminjamanForm" method="POST" action="{{ route('createPeminjaman') }}">
                    @csrf
                    <input type="hidden" name="buku_id" id="bukuId">
                    <div class="mb-3">
                        <label for="namaBuku" class="form-label">Nama Buku</label>
                        <input type="text" class="form-control" id="namaBuku" name="nama_buku" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPeminjaman" class="form-label">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggal_peminjaman" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tanggalPengembalian" name="tanggal_pengembalian" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- End Side Menu --}}
@endsection

@section('scripts')
<script>
    function openPeminjamanModal(bukuId, judul) {
        console.log(bukuId, judul);
        document.getElementById('bukuId').value = bukuId;
        document.getElementById('namaBuku').value = judul;
        // Open the modal
        $('#peminjamanModal').modal('show');
    }
</script>
@endsection