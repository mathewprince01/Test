<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function city(){
        return $this->hasMany(City::class);
    }

    public function event (){
        return $this->hasMany(Event::class);
    }
}
