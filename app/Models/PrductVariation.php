<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrductVariation extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size', 'color', 'price', 'quantity','discount_price'];

}
