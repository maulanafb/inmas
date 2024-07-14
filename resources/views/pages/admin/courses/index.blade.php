@extends('layouts.app')

@section('title')
    Member Area
@endsection

@push('addon-style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800&family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid page-body-wrapper">
        @include('includes.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-md-12 grid-margin transparent">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kursus</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>Thumbnail</th>
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>
                                                        @if ($course->thumbnail)
                                                            <img src="{{ asset($course->thumbnail) }}"
                                                                alt="{{ $course->title }}" width="100">
                                                        @else
                                                            No Thumbnail
                                                        @endif
                                                    </td>
                                                    <td>{{ $course->title }}</td>
                                                    <td>{{ Str::limit($course->description, 100) }}</td>

                                                    <td>

                                                        <a href="{{ route('courses.edit', $course->id) }}"
                                                            class="btn btn-success">Edit</a>
                                                        {{-- <form action="{{ route('courses.destroy', $course->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.
                        <a href="#" target="_blank">INMAS (Institut Masajidallah)</a>
                </div>
            </footer>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endpush
