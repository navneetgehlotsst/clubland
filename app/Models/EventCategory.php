<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventCategory extends Model {
    use SoftDeletes;

   
    public function getBusinessName() {
        return $this->belongsTo('App\Models\User', 'business_id', 'id');
    }
   
}
