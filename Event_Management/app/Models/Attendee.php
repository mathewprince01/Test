<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $guarded = [];
     public function user(){
        return $this->belongsTo(User::class);
     }
     public function ticket_purchases(){
        return $this->hasMany(TicketPurchase::class);
     }


}
