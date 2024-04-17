<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MembershipGuardiansDetail extends Model {
   
    use HasFactory;
    protected $table = 'membership_guardians_details';

    protected $fillable = [
        'payment_id','name','email','phone_number'];   
}
