<?php

namespace App\Modules\Models\Graduation;

use App\Modules\Models\Ceremony\Ceremony;
use App\Modules\Models\Institution\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'institution_id',
        'faculty',
        'color_code',
        'description',
        'image',
        'display_order',
        'status',
        'remarks',
        'created_by',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function ceremony()
    {
        return $this->hasMany(Ceremony::class);
    }
}
