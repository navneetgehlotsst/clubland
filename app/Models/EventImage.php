<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventImage extends Model {
    use SoftDeletes;

    protected $fillable = [
        'event_id',
        'image',
    ];
}
