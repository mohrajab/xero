<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Service
 *
 * @mixin \Eloquent
 */
class Service extends Model
{
    protected $fillable = ["name", "points"];
}
