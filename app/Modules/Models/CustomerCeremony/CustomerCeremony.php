<?php

namespace App\Modules\Models\CustomerCeremony;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCeremony extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'ceremony_id',
        'date',
        'time',
    ];
}
