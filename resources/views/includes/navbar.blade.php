<nav class="poppins navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="">
            <img src="{{ asset('images/logo-inmas.png') }}" class="mr-2" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="">
            <img src="{{ asset('images/logo-inmas.png') }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right ">
            {{-- <li class="nav-item dropdown">
                <div class="dropdown">
                    <button class="dropbtn p-4" id="dropdownBtn">
                        <i class="ti-settings text-primary"></i>
                    </button>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="#">
                            <i class="ti-settings text-primary"></i> Settings
                        </a>
                        <form action="{{ url('logout') }}" method="POST">
                            @csrf
                            <button type="submit dropbtn">
                                <i class="ti-power-off text-primary"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </li> --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas" id="toggle-sidebar-mobile">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
