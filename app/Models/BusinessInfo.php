<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    use HasFactory;
    protected $table = 'business_info';

    protected $fillable = [
        'business_id',
        'club_name',
        'club_type',
        'position',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
       
    ];
    protected $appends = ['banner_image_path'];


    public function getBannerImagePathAttribute() {
        $profile = $this->attributes['banner_image'];
        if($profile && !empty($profile)){
            return url('public/businessBanner/'.$profile);
        }
        else{
            return url('web/images/size-1920-300.jpg');
        }
    }
    public function get_club_type() {
        return $this->hasOne('App\Models\ClubType', 'id', 'club_type');
    }
}
