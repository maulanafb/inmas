<div>
    <div class="mt-2 mb-2">
        <div style="display:flex;gap:10px;align-items: center;">
            <span>Dari tanggal</span>
            <div>
                <input width="10" style="padding: 10px;margin: 0;" id="searchDateFrom" type="date"
                    wire:model.live="searchDateFrom" placeholder="From Date" class="form-control" />
            </div>
            <span>Sampai tanggal</span>
            <div>
                <input style="padding: 10px;" id="searchDateTo" type="date" wire:model.live="searchDateTo"
                    placeholder="To Date" class="form-control" />
            </div>
            <button style="margin: 0;" wire:click="clearDates" class="btn btn-secondary">Reset</button>
            <button style="margin: 0;" wire:click="exportToExcel" class="btn btn-success">Export Excel</button>
        </div>
    </div>

    <div class="mb-4 mt-4" style="display: flex;align-items: center;gap: 20px;">
        <div class="" style="align-self: flex-end">
            <input style="border-radius: 15px;margin: 0;" type="text" wire:model.debounce.300ms.live="search"
                placeholder="Cari Pengguna..." class="form-control " />
        </div>
        <span class="ml-auto text-right" style="flex: 1">Tampilkan : </span>
        <div class="ml-1" style="display: flex;align-items: center;justify-content: center">
            <select wire:model.live="perPage" class="form-control mr-1">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="-1">All data</option>
            </select>
        </div>
    </div>

    <div class="mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="cursor: pointer;" wire:click="sortBy('number')">
                        No.
                        @if ($sortField === 'number')
                            @if ($sortAsc)
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th style="cursor: pointer;" wire:click="sortBy('name')">
                        Name
                        @if ($sortField === 'name')
                            @if ($sortAsc)
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th style="cursor: pointer;" wire:click="sortBy('email')">
                        Email
                        @if ($sortField === 'email')
                            @if ($sortAsc)
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr wire:key="user-{{ $user->id }}">
                        <td>{{ $user->number }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{-- <button
                                onclick="showEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')"
                                class="btn btn-primary">Edit</button> --}}
                            <button onclick="showDeleteModal('{{ $user->id }}')"
                                class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $users->links('livewire::bootstrap') }}
    @endif

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showEditModal(userId, userName, userEmail) {
        let form = document.getElementById('editForm');
        form.action = '/admin/users/' + userId;
        document.getElementById('editName').value = userName;
        document.getElementById('editEmail').value = userEmail;
        $('#editModal').modal('show');
    }

    function showDeleteModal(userId) {
        let form = document.getElementById('deleteForm');
        form.action = '/admin/users/' + userId;
        $('#deleteModal').modal('show');
    }
</script>
