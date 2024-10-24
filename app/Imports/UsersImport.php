<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\Row;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (User::where('username', $row['asm_almstkhdm'])->exists()) {
            \Log::warning('Duplicate entry found for username: ' . $row['asm_almstkhdm']);
            return null;
        }

        return new User([
            'full_name' => $row['alasm_alkaml'],
            'employee_number' => $row['alrkm_alothyfy'],
            'role' => $row['alrtb'],
            'username' => $row['asm_almstkhdm'],
            'password' => $row['alrkm_alothyfy'],
        ]);
    }

    public function onRow(Row $row)
    {
        $user = $this->model($row->toArray());

        if ($user !== null) {
            $user->save();
        }
    }
}
