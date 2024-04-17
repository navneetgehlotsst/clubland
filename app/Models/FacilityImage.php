<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class FacilityImage extends Model {
    use SoftDeletes;

    protected $fillable = [
        'facility_id',
        'image',
    ];
}
