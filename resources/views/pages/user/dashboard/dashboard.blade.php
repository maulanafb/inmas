@extends('layouts.app')

@section('title')
    Member Area
@endsection
@push('addon-style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800&family=Poppins:wght@400;500&display=swap');

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .course:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .dashboard-subtitle {
            font-size: 1rem;
            color: #6c757d;
        }

        .course {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            font-family: 'Poppins', sans-serif;
            display: flex;

            flex-direction: column;
            /* border-radius: 20px; */
            width: 100%;
            overflow: hidden;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            margin-bottom: 20px;
        }

        .course:hover .course-title {
            white-space: normal;
            /* Membuat teks membungkus ke baris berikutnya saat hover */
        }

        .course-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* padding: 13px 0px; */
            padding-top: 13px;
            text-align: start;
            font-size: 20px;
            font-weight: 600;

        }

        .course-thumbnail {
            border-radius: 20px;
            aspec-ratio: 4/5;
            object-fit: cover;
        }

        a:hover {
            text-decoration: none;
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
                <h2 class="">Selamat Datang di member area INMAS</h2>
                <p class="dashboard-subtitle">Akses berbagai kursus dan materi pembelajaran</p>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        {{-- create wellcome and give naration  --}}

                        <div class="row mt-4">
                            @foreach ($courses as $course)
                                <a href="{{ route('user.class.index', $course->contents->first->id) }}" class="col-md-4">
                                    <div class="course">
                                        <div class="course-image">
                                            <img src="{{ $course->thumbnail }}" alt=""
                                                class="img-fluid course-thumbnail">
                                        </div>
                                        <div class="course-body">
                                            <div class="course-title">{{ $course->title }}</div>
                                            {{-- <div class="course-description">{{ $course->description }}</div> --}}
                                            {{-- buat ada icon world lalu tulisan event online --}}
                                            <div class="course-description">
                                                <i class="fas fa-globe"></i> Event Online
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>






            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer font-poppins">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.
                        <a href="https://institutmasajidallah.com/" target="_blank">INMAS (Institut Masajidallah)

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
