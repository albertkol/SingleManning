<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rota extends Model
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
