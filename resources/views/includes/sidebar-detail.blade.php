<nav class="sidebar sidebar-offcanvas poppins" id="sidebar">
    <ul class="nav poppins font-sm">
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title font-sm">Kembali</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title poppins">Data Masjid</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Profil
                            Masjid</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Tanah &
                            Bangunan</a></li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Profil
                            Manager</a></li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Program Masjid</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Struktur
                            Pengurus</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="finance">
                <i class="fas fa-wallet menu-icon"></i>
                <span class="menu-title poppins">Keuangan</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="finance">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Keuangan bulanan
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Pemasukan Jumat</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#checklist" aria-expanded="false"
                aria-controls="checklist">
                <i class="fas fa-tasks menu-icon"></i>
                <span class="menu-title font-sm">Laporan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="checklist">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Program Harian
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Program Pekanan</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="" style="font-size: 13px">Program Bulanan</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-images menu-icon"></i>
                <span class="menu-title font-sm">Galeri</span>
            </a>
        </li>




    </ul>
</nav>
<script>
    // Mendapatkan elemen tombol dan elemen navigasi
    var toggleButton = document.getElementById('toggle-sidebar-mobile');
    var sidebar = document.getElementById('sidebar');

    // Menambahkan event listener untuk meng-handle klik pada tombol
    toggleButton.addEventListener('click', function() {
        // Toggle kelas 'active' pada elemen navigasi
        sidebar.classList.toggle('active');
    });
</script>
