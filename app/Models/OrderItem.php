<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function getProductVariation()
    {
        return $this->belongsTo(PrductVariation::class,'variation_id');
    }

    public function getEventTicket()
    {
        return $this->belongsTo(EventAppend::class,'product_id');
    }

    public function getEvent()
    {
        return $this->belongsTo(Event::class,'product_id');
    }
    
}
