<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
