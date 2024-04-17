<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Product extends Model {

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->product_name);
            $product->slug = $product->getUniqueSlug($product->slug);
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
    public function getproductImage() {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }
    public function getproductVariation() {
        return $this->hasMany('App\Models\PrductVariation', 'product_id', 'id');
    }

    public function getproductVariationOptionSize() {
        return $this->hasMany('App\Models\PrductVariationOption', 'product_id', 'id')->where('type','size');
    }

    public function getproductVariationOptionColor() {
        return $this->hasMany('App\Models\PrductVariationOption', 'product_id', 'id')->where('type','color');
    }

    //ShopPoratal 

    public function getproductVariationSizeShoPortal() {
        return $this->hasMany('App\Models\PrductVariation', 'product_id', 'id')->groupBy('size');
    }

    public function getproductVariationColorShoPortal() {
        return $this->hasMany('App\Models\PrductVariation', 'product_id', 'id')->groupBy('color');
    }

    public function getproductVariationColorCount() {
        return $this->hasMany('App\Models\PrductVariation', 'product_id', 'id')->where('color','!=','');
    }

    public function getproductVariationSizeCount() {
        return $this->hasMany('App\Models\PrductVariation', 'product_id', 'id')->where('size','!=','');
    }

}
