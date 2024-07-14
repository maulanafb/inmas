<?php

namespace App\Livewire;

use App\Exports\UsersExport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class UserTableComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $searchDateFrom = null;
    public $searchDateTo = null;
    public $perPage = 10;
    public $sortField = 'name';
    public $sortAsc = true;

    protected $queryString = [
        'search' => ['except' => ''],
        'searchDateFrom' => ['except' => null],
        'searchDateTo' => ['except' => null],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'name'],
        'sortAsc' => ['except' => true],
    ];

    public function render()
    {
        if ($this->perPage == -1) {
            $users = User::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->when($this->searchDateFrom, function ($query) {
                    $query->whereDate('created_at', '>=', $this->searchDateFrom);
                })
                ->when($this->searchDateTo, function ($query) {
                    $query->whereDate('created_at', '<=', $this->searchDateTo);
                })
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->get(); // Menggunakan get() untuk mendapatkan semua data tanpa paginasi

            // Lakukan transformasi data atau manipulasi lainnya jika diperlukan
            $pageNumber = 0;
            $users->transform(function ($user) use (&$pageNumber) {
                $user->number = ++$pageNumber;
                return $user;
            });
        } else {
            $users = User::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->when($this->searchDateFrom, function ($query) {
                    $query->whereDate('created_at', '>=', $this->searchDateFrom);
                })
                ->when($this->searchDateTo, function ($query) {
                    $query->whereDate('created_at', '<=', $this->searchDateTo);
                })
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage); // Gunakan paginate() untuk paginasi biasa

            // Lakukan transformasi data atau manipulasi lainnya jika diperlukan
            $pageNumber = ($users->currentPage() - 1) * $users->perPage();
            $users->transform(function ($user) use (&$pageNumber) {
                $user->number = ++$pageNumber;
                return $user;
            });
        }

        return view('livewire.user-table-component', [
            'users' => $users,
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function clearDates()
    {
        $this->searchDateFrom = null;
        $this->searchDateTo = null;
    }
    public function exportToExcel()
    {
        return Excel::download(
            new UsersExport(
                $this->search,
                $this->searchDateFrom,
                $this->searchDateTo,
                $this->sortField,
                $this->sortAsc
            ),
            'users.xlsx'
        );
    }
}
