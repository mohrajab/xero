<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
