<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'movie_title', 'seats', 'date_time', ]; //'total_amount'

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
