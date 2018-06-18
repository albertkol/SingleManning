<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftBreak extends Model
{
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
