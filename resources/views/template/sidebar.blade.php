<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{url('home')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading"> Buku </div>

                    <div class="sb-nav-link-icon" class="bi bi-journal-album">
                        <a class="nav-link" href="{{url('kategori')}}">Kategori buku</a>
                    </div>
                    <div class="sb-nav-link-icon" class="bi bi-journal-album">
                        <a class="nav-link" href="{{url('list-buku')}}">list buku</a>
                    </div>
                    <div class="sb-nav-link-icon" class="bi bi-journal-album">
                        <a class="nav-link" href="{{url('list-peminjaman')}}">list peminjaman buku</a>
                    </div>


                    <div class="sb-sidenav-menu-heading">Log History</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Log History
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{url('log-peminjaman')}}">Log peminjaman</a>
                            <a class="nav-link" href="log-pengembalian">Log pengembalian</a>
                        </nav>
                    </div>


                    <div class="sb-sidenav-menu-heading">User</div>
                    <a class="nav-link" href="{{url('admin/userlist')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        User List
                    </a>
                    <!-- <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        profile
                    </a> -->
                </div>
            </div>

        </nav>
    </div>