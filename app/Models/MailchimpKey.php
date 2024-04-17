<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MailchimpKey extends Model {
   
    use HasFactory;
    protected $table = 'mailchimp_keys';

    protected $fillable = [
        'business_id','key','audience_id','prifixed_value'];   
}
