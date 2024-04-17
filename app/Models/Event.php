<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model {

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->slug = Str::slug($event->name);
            $event->slug = $event->getUniqueSlug($event->slug);
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
    public function getEventCategory() {
        return $this->belongsTo('App\Models\EventCategory', 'category_id', 'id');
    }

    public function getEventAppend() {
        return $this->hasMany('App\Models\EventAppend', 'event_id', 'id');
    }

    public function geteventImage() {
        return $this->hasMany('App\Models\EventImage', 'event_id', 'id');
    }

    public function geteventTicket() {
        return $this->hasMany('App\Models\EventAppend', 'event_id', 'id');
    }

}
