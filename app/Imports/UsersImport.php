<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\Row;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersImport implements ToModel, WithHeadingRow
{
    const DEPARTMENT_COLUMN = 'alksm';
    const PROGRAM_COLUMN = 'albrnamg';
    const USERNAME_COLUMN = 'asm_almstkhdm';
    const FULL_NAME_COLUMN = 'alasm_alkaml';
    const EMPLOYEE_NUMBER_COLUMN = 'alrkm_alothyfy';
    const ROLE_COLUMN = 'alrtb';

    public function model(array $row)
    {
        // Validate row data
        $validator = Validator::make($row, [
            self::DEPARTMENT_COLUMN => 'required|string',
            self::PROGRAM_COLUMN => 'required|string',
            self::USERNAME_COLUMN => 'required|string|unique:users,username',
            self::FULL_NAME_COLUMN => 'required|string',
            self::EMPLOYEE_NUMBER_COLUMN => 'required|numeric|unique:users,employee_number',
            self::ROLE_COLUMN => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for row: ' . json_encode($row), $validator->errors()->toArray());
            return null;
        }

        $department = Department::where('name', $row[self::DEPARTMENT_COLUMN])->first();
        $program = Program::where('name', $row[self::PROGRAM_COLUMN])->first();

        if (!$department) {
            Log::warning('Department not found for: ' . $row[self::DEPARTMENT_COLUMN]);
            return null;
        }

        if (!$program) {
            Log::warning('Program not found for: ' . $row[self::PROGRAM_COLUMN]);
            return null;
        }

        return new User([
            'full_name' => $row[self::FULL_NAME_COLUMN],
            'department_id' => $department->id,
            'program_id' => $program->id,
            'employee_number' => $row[self::EMPLOYEE_NUMBER_COLUMN],
            'role' => $row[self::ROLE_COLUMN],
            'username' => $row[self::USERNAME_COLUMN],
            'password' => $row[self::EMPLOYEE_NUMBER_COLUMN],
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
