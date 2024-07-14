<nav class="sidebar sidebar-offcanvas poppins" id="sidebar">
    <ul class="nav poppins font-sm">


        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title font-sm">Dashboard</span>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title font-sm">Dashboard</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title font-sm">Pengguna</span>
                </a>
            </li>
        @endif
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courses.index') }}">
                    <i class="fas fa-chalkboard-teacher menu-icon"></i>
                    <span class="menu-title font-sm">kursus</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->hasRole(['user', 'admin']))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile.edit') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title font-sm">Profile</span>
                </a>
            </li>
        @endif

        {{-- <li class="nav-item">
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
        </li> --}}
        <li class="nav-item">

        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"
                style=" border: none; cursor: pointer;">
                <i class="fas fa-sign-out-alt menu-icon"></i>
                <span class="menu-title font-sm">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
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
