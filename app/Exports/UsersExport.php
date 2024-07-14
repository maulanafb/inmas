<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    public $search;
    public $searchDateFrom;
    public $searchDateTo;
    public $sortField;
    public $sortAsc;

    public function __construct($search, $searchDateFrom, $searchDateTo, $sortField, $sortAsc)
    {
        $this->search = $search;
        $this->searchDateFrom = $searchDateFrom;
        $this->searchDateTo = $searchDateTo;
        $this->sortField = $sortField;
        $this->sortAsc = $sortAsc;
    }

    public function query()
    {
        return User::query()
            ->with('city')
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
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'No Hp',
            'Kota/Kabupaten', // Add City heading
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone_number,
            $user->city ? $user->city->name : '', // Add city name
        ];
    }
}
