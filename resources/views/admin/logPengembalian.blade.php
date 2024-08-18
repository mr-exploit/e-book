@extends('template.app')

@section('title', 'Log List Pengembalian Buku')

@section('content')
{{-- Side Menu --}}
<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-3"> List Pengembalian Buku</h2>
        <table id="ListLogPengembalian" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Jumlah Halaman</th>
                    <th>Sinopsis</th>
                    <th>Tanggal Pengembalian</th>
                    <th>nama Peminjam</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalians as $pengembalian)
                <tr>
                    <td>{{ $pengembalian->buku->judul ?? 'N/A' }}</td>
                    <td>{{ $pengembalian->buku->kategori ? $pengembalian->buku->kategori->nama : 'N/A' }}</td>
                    <td>{{ $pengembalian->buku->jumlah_halaman ?? 'N/A' }}</td>
                    <td>{{ $pengembalian->buku->sinopsis ?? 'N/A' }}</td>
                    <td>{{ $pengembalian->tanggal_pengembalian ?? 'N/A' }}</td>
                    <td>{{$pengembalian->user->nama}}</td>
                    <td>{{$pengembalian->status}}</td>
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
        $('#ListLogPengembalian').DataTable();
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