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

class GraduateImport implements ToModel,WithHeadingRow, WithValidation
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd(explode("-", $row['graduation'], 2));
        return new Graduates([
            //
            "graduation_id" => strstr($row['graduation'], '-', true),
            "student_id" => $row['student_id'],
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email_personal'],
            "alternative_email" => $row['alternative_email'],
            "mobile" => $row['mobile'],
            "password" => Hash::make($row['last_name']),
        ]);
    }

    public function rules(): array
    {
        return[
            '*.graduation'=> 'required|max:191|exists:graduations,id',
            '*.student_id'=> 'required|max:191|unique:customers,student_id',
            '*.email_personal'=> 'required|email|max:191|unique:customers,email',
            '*.first_name'=> 'required',
            '*.last_name'=> 'required',
        ];
    }
}
