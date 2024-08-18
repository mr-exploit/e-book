@extends('template.app')

@section('title', 'Buku')

@section('content')
{{-- Side Menu --}}
<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-5">Buku</h2>

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Judul buku</th>
                    <th>Penulis</th>
                    <th>Penernbit</th>
                    <th>Sinopsis</th>
                    <th>tahun terbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                <tr>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->deskripsi ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('buku')}}" class="btn btn-warning text-white">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <a href="{{ route('deleteKategori', ['id' => $kategori->id]) }}" class="btn btn-danger">
                            <i class="fas fa-trash fa-fw"></i>
                        </a>
                    </td>
                </tr>
                @endforeach


            </tbody>

        </table>
    </div>
</div>



{{-- End Side Menu --}}
@endsection