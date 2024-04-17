<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductImage extends Model {
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'image',
        
    ];

   

    
}
