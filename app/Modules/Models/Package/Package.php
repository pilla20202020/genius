<?php

namespace App\Modules\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'image',
        'type',
        'studio_photo',
        'presentation_photo',
        'display_order',
        'status',
        'remarks',
        'created_by',
    ];
}
