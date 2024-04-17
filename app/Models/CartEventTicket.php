<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartEventTicket extends Model
{
    use HasFactory;

    public function getticketdata() {
        return $this->belongsTo('App\Models\EventAppend', 'ticket_id', 'id');
    }
}
