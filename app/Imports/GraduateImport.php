<?php

namespace App\Imports;

use App\Modules\Models\Customer\Customer;
use App\Modules\Models\Graduates\Graduates;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class GraduateImport implements ToModel,WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Graduates([
            //
            "student_id" => $row['student_id'],
            "graduation_id" => $row['graduation_id'],
            "ceremony_id" => $row['ceremony_id'],
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email'],
            "mobile" => $row['mobile'],
            "password" => Hash::make($row['last_name']),
            "status" => $row['status'],
            "created_by" => $row['created_by'],
            "created_at" => $row['created_at'],
            "updated_at" => $row['updated_at'],
        
        ]);
    }

    public function rules(): array
    {
        return[
            '*.email'=> 'required|email|max:191|unique:customers,email',

        ];
    }
}
