<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class HeaderSecation extends Model {

    protected $fillable = [
        'business_id',
    ];

    // public function getLogoImageAttribute() {
    //     $profile = $this->attributes['logo_image'];
    //     if($profile && !empty($profile)){
    //         return url('public/image_logo/'.$profile);
    //     }
    //     else{
    //         return url('web/images/size-500-500.jpg');
    //     }
    // }

}
