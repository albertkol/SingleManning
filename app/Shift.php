<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function shiftBreaks()
    {
        return $this->hasMany(ShiftBreak::class);
    }
}
