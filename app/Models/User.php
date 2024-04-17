<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use function Illuminate\Events\queueable;
use Illuminate\Support\Str;

Use Carbon\Carbon;
use DB;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable,Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'email',
        'password',
        'phone_number',
        'gender',
        'role',
        'address',
        'device_token',
        'stripe_id',
        'about',
        'country_code',
        'club'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    
        'password' => 'hashed',
    ];

    public function getJWTIdentifier() {
        return  $this->getKey();
    }

    protected $appends = ['image_path'];

    public function getJWTCustomClaims()
    {
        return [];
    }

    
    public function getImagePathAttribute() {
        $profile = $this->attributes['profile_pic'];
        if($profile && !empty($profile)){
            return url('public/user/'.$profile);
        }
        else{
            return url('web/images/user-img.png');
        }
    }

    public function business_info() {
        return $this->belongsTo('App\Models\BusinessInfo', 'id', 'business_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = Str::slug($user->club);
            $user->slug = $user->getUniqueSlug($user->slug);
        });
    }

    // Additional methods...

    public function getUniqueSlug($proposedSlug)
    {
        $slug = $this->clean($proposedSlug);
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $proposedSlug . '-' . $count++;
        }

        return $slug;
    }

    public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}
