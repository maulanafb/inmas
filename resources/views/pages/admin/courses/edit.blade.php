@extends('layouts.app')

@section('title')
    Edit Course
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
        @include('includes.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Kursus</h4>
                                <form action="{{ route('courses.update', $course->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $course->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $course->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Kursus</label>
                                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                                        @if ($course->thumbnail)
                                            <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" width="100"
                                                class="mt-2">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Perbarui Kursus</button>
                                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
                                </form>
                                <hr><br>
                                <h4 class="card-title">Konten Kursus</h4>
                                <button class="btn btn-primary mb-3" data-toggle="modal"
                                    data-target="#createContentModal">Tambah konten</button>
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Video URL</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course_contents as $content)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $content->title }}</td>
                                                    <td>{{ $content->video_url }}</td>
                                                    <td>
                                                        <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#editContentModal{{ $content->id }}">Edit</button>
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteContentModal{{ $content->id }}">Delete</button>
                                                    </td>
                                                </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editContentModal{{ $content->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editContentModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editContentModalLabel">Edit
                                                                    Content</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('courses.contents.update', [$course->id, $content->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label for="title">Title</label>
                                                                        <input type="text" class="form-control"
                                                                            id="title" name="title"
                                                                            value="{{ $content->title }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="video_url">Video URL</label>
                                                                        <input type="text" class="form-control"
                                                                            id="video_url" name="video_url"
                                                                            value="{{ $content->video_url }}">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteContentModal{{ $content->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteContentModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteContentModalLabel">
                                                                    Delete Content</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this content?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('courses.contents.destroy', [$course->id, $content->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Yes,
                                                                        delete</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <br>
                                </div>

                                <hr><br>
                                {{-- Start Modul Belajar --}}
                                <h4>Modul Belajar</h4>
                                <button class="btn btn-primary mb-3" data-toggle="modal"
                                    data-target="#createModuleModal">Tambah Modul</button>
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Guide URL</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($learning_modules as $module)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $module->title }}</td>
                                                    <td>
                                                        @if ($module->guide_url)
                                                            <a href="{{ asset('storage/' . $module->guide_url) }}"
                                                                download><button
                                                                    class="btn btn-primary">Download</button></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#editModuleModal{{ $module->id }}">Edit</button>
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModuleModal{{ $module->id }}">Delete</button>
                                                    </td>
                                                </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModuleModal{{ $module->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModuleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModuleModalLabel">Edit
                                                                    Modul</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('learning-modules.update', [$module->id]) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label for="title">Title</label>
                                                                        <input type="text" class="form-control"
                                                                            id="title" name="title"
                                                                            value="{{ $module->title }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="guide_url">File Module</label>
                                                                        <input type="file" class="form-control"
                                                                            id="guide_url" name="guide_url">
                                                                        @if ($module->guide_url)
                                                                            <a href="{{ asset('storage/' . $module->guide_url) }}"
                                                                                download>

                                                                                <button
                                                                                    class="btn btn-primary">Download</button>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModuleModal{{ $module->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteModuleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModuleModalLabel">
                                                                    Delete Modul</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this module?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('learning-modules.destroy', [$module->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Yes,
                                                                        delete</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- End Modul Belajar --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Content Modal -->
    <div class="modal fade" id="createContentModal" tabindex="-1" role="dialog"
        aria-labelledby="createContentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createContentModalLabel">Tambah Konten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('courses.contents.store', $course->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="video_url">Video URL</label>
                            <input type="text" class="form-control" id="video_url" name="video_url">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Module Modal -->
    <div class="modal fade" id="createModuleModal" tabindex="-1" role="dialog"
        aria-labelledby="createModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModuleModalLabel">Tambah Modul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('learning-modules.store', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="guide_url">Guide URL</label>
                            <input type="file" class="form-control" id="guide_url" name="guide_url">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-KyZXEAg3QhqLMpG8r+Knujsl5/6po7j2+t9e12h7V+4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkH7o7LBwMXHa8H27BZN5oz5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endpush
