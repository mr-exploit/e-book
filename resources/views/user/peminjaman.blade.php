@extends('layouts.app')

@section('title', 'List Peminjaman Buku')

@section('content')
{{-- Side Menu --}}

<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-3"> List Peminjaman Buku</h2>
        <table id="ListPeminjaman" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>sinopsis</th>
                    <th>peminjaman</th>
                    <th>pengembalian</th>
                    <th>img_buku</th>
                    <th>file_buku</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->buku->kategori ? $peminjaman->buku->kategori->nama : 'N/A' }}</td>
                    <td>{{ $peminjaman->buku->jumlah_halaman ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->buku->sinopsis ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->tanggal_pengembalian ?? 'N/A' }}</td>
                    <td>
                        @if($peminjaman->buku->img_buku)
                        <a data-bs-toggle="modal" class='text-blue' data-bs-target="#proofModal{{ $peminjaman->buku->id }}">
                            View Buku
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="proofModal{{ $peminjaman->buku->id }}" tabindex="-1" aria-labelledby="proofModalLabel{{ $peminjaman->buku->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="proofModalLabel{{ $peminjaman->buku->id }}">Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/buku/' . $peminjaman->buku->img_buku) }}" alt="Buku" class="img-fluid" width="50%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        @if($peminjaman->buku->file_buku)
                        <a data-bs-toggle="modal" class='text-blue' data-bs-target="#fileModal{{ $peminjaman->buku->id }}">
                            View File Buku
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="fileModal{{ $peminjaman->buku->id }}" tabindex="-1" aria-labelledby="fileModalLabel{{ $peminjaman->buku->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fileModalLabel{{ $peminjaman->buku->id }}">Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <embed src="{{ asset($peminjaman->buku->file_buku) }}" type="application/pdf" width="100%" height="600px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>{{ $peminjaman->status ?? 'N/A' }}</td>
                    <td>
                        @if($peminjaman->status == 'waiting approve peminjaman')
                        <button type="button" class="btn btn-secondary" disabled>Waiting Approval</button>
                        @else
                        <form id="delete-form-{{ $peminjaman->id }}" action="{{ route('pengembalianBuku', ['id' => $peminjaman->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmBukuPengembelian({{ $peminjaman->id }})">
                                <i class="fa-solid fa-book"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

{{-- End Side Menu --}}
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#ListPeminjaman').DataTable();
    });

    function confirmBukuPengembelian(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Buku yang Sudah Anda Balikkan, Bisa dipinjam kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Balikkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection