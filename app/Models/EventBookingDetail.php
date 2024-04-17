<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventBookingDetail extends Model {
    protected $table = 'event_booking_details';


    protected $fillable = ['payment_id', 'event_id', 'name', 'email','phone'];

}
