<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'price',
        'description',

    ];
    public function getRouteKeyName(){
        return 'slug';
    }

    public function getImageAttribute() {
        $profile = $this->attributes['image'];
        if($profile && !empty($profile)){
            return url($profile);
        }
        else{
            return null;
        }
    }
}
