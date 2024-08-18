@extends('template.app')

@section('title', 'Log List Peminjaman Buku')

@section('content')
{{-- Side Menu --}}

<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-3"> List Peminjaman Buku</h2>
        <table id="ListLogPeminjaman" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>nama Peminjam</th>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>sinopsis</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->user->nama ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->buku->judul ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->buku->kategori->nama ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->buku->jumlah_halaman ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->buku->sinopsis ?? 'N/A' }}</td>
                    <td>{{ $peminjaman->status ?? 'N/A' }}</td>

                </tr>
                @endforeach


            </tbody>

        </table>
    </div>
</div>

{{-- End Side Menu --}}
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#ListLogPeminjaman').DataTable();
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
@endsection`