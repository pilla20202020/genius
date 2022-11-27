<?php

namespace App\Modules\Models\Graduates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduates extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'graduation_id',
        'ceremony_id',
        'first_name',
        'last_name',
        'student_id',
        'email',
        'mobile',
        'password',
        'display_order',
        'status',
        'remarks',
        'created_by',
    ];

}
