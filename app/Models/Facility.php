<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Facility extends Model {

    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facility) {
            $facility->slug = Str::slug($facility->name);
            $facility->slug = $facility->getUniqueSlug($facility->slug);
        });
    }

    // Additional methods...

    public function getUniqueSlug($proposedSlug)
    {
        $slug = $proposedSlug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $proposedSlug . '-' . $count++;
        }

        return $slug;
    }
    
    public function getfacilityImage() {
        return $this->hasMany('App\Models\FacilityImage', 'facility_id', 'id');
    }
}
