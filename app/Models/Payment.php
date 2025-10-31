<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['date_time', 'total_amount', 'booking_id', 'payment_method_id', 'payment_method_name'];
}
