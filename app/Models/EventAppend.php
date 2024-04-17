<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventAppend extends Model {

    protected $fillable = ['event_id', 'ticket_name', 'ticket_cost', 'ticket_quantity'];


}
