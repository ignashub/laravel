<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'Username',
            'Email',
            'Is super',
            'Created',
            'Updated',
        ];
    }
    public function collection()
    {
        return DB::table('users')->select('id', 'name', 'email', 'is_admin', 'created_at', 'updated_at')->get();
    }
}
