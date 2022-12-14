<?php

namespace App\Modules\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Customer extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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
