@extends('layouts.app')

@section('title')
    Edit Profile
@endsection

@push('addon-style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800&family=Poppins:wght@400;500&display=swap');

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .form-control {
            border-radius: 0.375rem;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            box-sizing: border-box;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            top: 3px;
        }

        @media (max-width: 576px) {
            .select2-container .select2-selection--single {
                width: 100% !important;
                height: auto !important;
                padding: 10px 12px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: normal;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: auto;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        .form-group img {
            display: block;
            margin-top: 10px;
            max-width: 100px;
            height: auto;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 15px;
            }

            .form-group img {
                max-width: 80px;
            }
        }

        .profile-section {
            display: flex;
            align-items: center;
            justify-content: start;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .profile-picture img {
            border-radius: 50%;
            max-width: 120px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .profile-picture img:hover {
            opacity: 0.8;
        }

        .profile-section label {
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid page-body-wrapper">
        @include('includes.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mx-auto mt-3 mb-3 text-center">Profile</h3>
                                <hr>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('user.profile.update') }}"
                                    enctype="multipart/form-data" onsubmit="return validatePassword();">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 profile-section mx-auto">
                                            <div class="profile-picture justify-center">
                                                <div class="row">
                                                    <div
                                                        class="col-12 d-flex flex-column align-items-center justify-content-center">
                                                        @if ($user->profile_photo)
                                                            <img src="{{ asset('images/' . $user->profile_photo) }}"
                                                                alt="Profile Photo" class="rounded-circle mb-2">
                                                        @else
                                                            <img src="/images/default-pp.png" alt="Default Profile Photo"
                                                                class="rounded-circle mb-2">
                                                        @endif
                                                        <label for="profile_photo"
                                                            class="btn btn-outline-primary">Upload/Ganti Foto</label>
                                                        <input id="profile_photo" type="file"
                                                            class="form-control @error('profile_photo') is-invalid @enderror"
                                                            name="profile_photo" style="display: none;">
                                                    </div>
                                                </div>
                                                @error('profile_photo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name', $user->name) }}" required autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number">No. Whatsapp</label>
                                                <input id="phone_number" type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    name="phone_number"
                                                    value="{{ old('phone_number', $user->phone_number) }}" required>
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email', $user->email) }}" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Ubah Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Konfirmasi Password</label>
                                                <input id="password_confirmation" type="password" class="form-control"
                                                    name="password_confirmation">
                                            </div>
                                            <div class="form-group">
                                                <label for="city_id">Domisili</label>
                                                <select id="city_id"
                                                    class="form-control @error('city_id') is-invalid @enderror"
                                                    name="city_id">
                                                    <option value="">Silahkan pilih kota/kabupaten</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $user->city_id == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.
                        <a href="#" target="_blank">INMAS (Institut Masajidallah)</a>
                    </span>
                </div>
            </footer>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#city_id').select2({
                placeholder: 'Silahkan pilih kota/kabupaten',
                allowClear: true
            });

            $('#profile_photo').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).siblings('label').html(fileName);
            });
        });

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password_confirmation").value;

            if (password !== confirmPassword) {
                alert("Password dan Konfirmasi Password tidak cocok.");
                return false;
            }
            return true;
        }
    </script>
@endpush
