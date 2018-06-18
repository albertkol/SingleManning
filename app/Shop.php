<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function rotas()
    {
        return $this->hasMany(Rota::class);
    }
}
