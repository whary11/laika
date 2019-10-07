<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
