<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MembershipPlan extends Model {
    use SoftDeletes;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            $member->slug = Str::slug($member->plan_name);
            $member->slug = $member->getUniqueSlug($member->slug);
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
    public function getBenefitAppend() {
        return $this->hasMany('App\Models\MembershipPlanAppend', 'membeship_id', 'id');
    }

    public function getOwnQuestion() {
        return $this->hasMany('App\Models\OwnQuestion', 'membeship_id', 'id');
        
    }

   
}
