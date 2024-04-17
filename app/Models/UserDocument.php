<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UserDocument extends Model {
    protected $table = 'user_documents';
    protected $fillable = [
        'user_id',
        'image'];

    // public function getImageAttribute() {
    //     $profile = $this->attributes['image'];
    //     if($profile && !empty($profile)){
    //         return url('public/document/'.$profile);
    //     }
    //     else{
    //         return "";
    //     }
    // }


}
