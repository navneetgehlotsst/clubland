<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function booking()
    {
        return $this->belongsTo(Booking::class,'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'payment_user_id');
    }

    public function getFacility()
    {
        return $this->belongsTo(Facility::class,'booking_id');
    }
    public function getMemeberShip()
    {
        return $this->belongsTo(MembershipPlan::class,'booking_id');
    }
    public function getOrderItem()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');

    }

    public function getproductOrderItem()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'booking_id');

    }

    public function getproductOrderItemHistory()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'booking_id')->where('type','product');

    }

    public function geteventOrderItemHistory()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'booking_id')->where('type','event')->groupBy('product_id');

    }


    public function getMemeberShipQuestion()
    {
        return $this->hasMany('App\Models\OwnQuestion', 'membeship_id', 'booking_id');

    }

    public function getMemeberShipMember()
    {
        return $this->hasMany('App\Models\MembershipPeople', 'payment_id', 'id');

    }

    public function getmembershipGuardiansDetails()
    {
        return $this->hasOne('App\Models\MembershipGuardiansDetail', 'payment_id', 'id');

    }

    public function getevent()
    {
        return $this->belongsTo(Event::class,'booking_id');
    }

}
