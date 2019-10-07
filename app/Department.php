<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function  municipality()
    {
        return $this->hasMany(Municipality::class);
    }
}
