<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all()->map(function ($user) {

            // cek apakah password pernah diubah
            $passwordStatus = $user->created_at == $user->updated_at
                ? 'Password belum di ubah'
                : 'Password sudah di ubah';

            return [
                'Name' => $user->name,
                'Email' => $user->email,
                'Password Status' => $passwordStatus,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Password Status',
        ];
    }
}