@extends('layouts.app')

@section('title', 'Data buku')

@section('content')
{{-- Side Menu --}}

<!-- <div class="container mt-5 p-5">
    <div class="row">
        <h1>Tentang aplikasi</h1>
    </div>
</div> -->

<div class="mb-3" style="width: auto;">
    <header class="hero-section text-center text-dark">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Aplikasi Peminjaman Buku</h1>
            <p class="lead">Temukan dan pinjam buku dengan mudah melalui platform kami yang mudah digunakan.</p>
            <a href="{{url('buku')}}" class="btn btn-primary btn-lg">Lihat Buku</a>
        </div>
        <div class="mb-3">

            <section id="features" class="py-5">
                <div class="container">
                    <h2 class="text-center ">Fitur Utama</h2>
                    <div class="row">
                        <div class=" text-center ">
                            <div class="features-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h4>Beragam Buku</h4>
                            <p>Jelajahi berbagai koleksi buku dari berbagai genre dan topik.</p>
                        </div>
                        <div class=" text-center ">
                            <div class="features-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h4>Pinjam Mudah</h4>
                            <p>Proses peminjaman yang cepat dan mudah hanya dengan beberapa klik.</p>
                        </div>
                        <div class=" text-center ">
                            <div class="features-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h4>Manajemen Akun</h4>
                            <p>Kelola akun dan riwayat peminjaman dengan mudah melalui dasbor pribadi.</p>
                        </div>
                    </div>
                </div>
            </section>
            <div class="mb-3">
                <section id="about" class="bg-light">
                    <div class="container">
                        <h2 class="text-center ">Tentang Kami</h2>
                        <p class="text-center">Aplikasi Peminjaman Buku adalah platform yang dirancang untuk mempermudah Anda dalam mencari, meminjam, dan mengelola buku. Kami berkomitmen untuk menyediakan akses mudah ke koleksi buku yang berkualitas dan layanan pelanggan yang terbaik.</p>
                    </div>
                </section>
                <div class="mb-3">
                    <section id="contact">
                        <div class="container">
                            <h2 class="text-center ">Kontak Kami</h2>
                            <div class="mb-3">
                                <i class="bi bi-instagram">ig: adminPerpus</i>
                                <i class="mb-6">wa: 08212132312312</i>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="mb-5">
                    <footer class="bg-dark text-white text-center py-3">
                        <p class="mb-0">&copy; 2024 Aplikasi Peminjaman Buku. Semua hak cipta dilindungi.</p>
                    </footer>

                </div>
            </div>
        </div>
    </header>

</div>



{{-- End Side Menu --}}
@endsection