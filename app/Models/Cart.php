<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Cart extends Model {

    // Additional methods...

    public function getproductdata() {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function getvariationdata() {
        return $this->belongsTo('App\Models\PrductVariation', 'variation_id', 'id');
    }

    public function geteventdata() {
        return $this->belongsTo('App\Models\Event', 'product_id', 'id');
    }
    public function geteventticketdata() {
        return $this->hasMany('App\Models\CartEventTicket', 'cart_id', 'id');
    }

}
