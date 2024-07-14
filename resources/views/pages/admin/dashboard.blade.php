@extends('layouts.app')

@section('title')
    Admin INMAS
@endsection
@push('addon-style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800&family=Poppins:wght@400;500&display=swap');

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">

            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>

        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        @include('includes.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <!-- Card untuk menampilkan jumlah pengguna -->
                        <div class="card">

                            <div class="card-body">
                                <h4>Jumlah Pengguna</h4>
                                <p class="font-poppins">Total Pengguna: {{ $userCount }}</p>
                            </div>
                        </div>
                    </div>

                </div>






            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.
                        <a href="#" target="_blank">INMAS (Institut Masajidallah)

                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
@endsection
@push('addon-script')
    <script>
        $(document).ready(function() {
            $('.nav-link[data-toggle="collapses"]').on('click', function(e) {
                e.preventDefault(); // Mencegah tautan dari mengarahkan ke halaman lain

                var target = $($(this).attr('href'));
                if (target.length) {
                    // Cek apakah elemen sudah terbuka atau tertutup
                    if (target.hasClass('show')) {
                        target.collapses('hide'); // Jika sudah terbuka, sembunyikan elemen
                    } else {
                        target.collapses('show'); // Jika sudah tertutup, tampilkan elemen
                    }
                }
            });
        });
    </script>
@endpush
