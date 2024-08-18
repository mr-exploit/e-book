@extends('template.app')

@section('title', 'Buku')

@section('content')
{{-- Side Menu --}}
<div class="container mt-5 p-5">
    <div class="">
        <h2 class="mb-5">Dashboard admin</h2>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <h2 class="card-title">Total User</h2>
                        <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalAccount}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <h2 class="card-title">User Laki-laki</h2>
                        <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalUserLaki}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <h2 class="card-title">User Perempuan</h2>
                        <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalUserPerempuan}}</h4>

                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Peminjaman</h2>
                            <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalPeminjaman}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Pengembalian</h2>
                            <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalPengembalian}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Buku</h2>
                            <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalBuku}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Kategori</h2>
                            <h4 class="card-subtitle mt-5 text-center text-bold">{{$totalKategori}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



{{-- End Side Menu --}}
@endsection