@extends('layouts.app')

@section('title', 'List Pengembalian Buku')

@section('content')
{{-- Side Menu --}}

<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-3"> List Pengembalian Buku</h2>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalians as $pengembalian)
                <tr>
                    <td>{{ $pengembalian->buku->judul }}</td>
                    <td>{{ $pengembalian->buku->kategori ? $pengembalian->buku->kategori->nama : 'N/A' }}</td>
                    <td>{{ $pengembalian->buku->jumlah_halaman ?? 'N/A' }}</td>
                    <td>{{ $pengembalian->buku->sinopsis ?? 'N/A' }}</td>
                    <td>{{ $pengembalian->tanggal_peminjaman ?? 'N/A' }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian ?? 'N/A' }}</td>
                    <td>
                        @if($pengembalian->buku->img_buku)
                        <a data-bs-toggle="modal" class='text-blue' data-bs-target="#proofModal{{ $pengembalian->buku->id }}">
                            View Buku
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="proofModal{{ $pengembalian->buku->id }}" tabindex="-1" aria-labelledby="proofModalLabel{{ $pengembalian->buku->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="proofModalLabel{{ $pengembalian->buku->id }}">Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/buku/' . $pengembalian->buku->img_buku) }}" alt="Buku" class="img-fluid" width="50%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        N/A
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