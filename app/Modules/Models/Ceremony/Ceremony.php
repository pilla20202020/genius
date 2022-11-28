<?php

namespace App\Modules\Models\Ceremony;

use App\Modules\Models\Graduation\Graduation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceremony extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'graduation_id',
        'date',
        'location',
        'time',
        'display_order',
        'status',
        'remarks',
        'created_by',
    ];

    public function graduation()
    {
        return $this->belongsTo(Graduation::class);
    }
}
