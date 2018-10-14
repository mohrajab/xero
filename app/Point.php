<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Point
 *
 * @mixin \Eloquent
 */
class Point extends Model
{
    protected $fillable = ['team_id', 'user_id', 'points', 'subscription_id', 'service_id'];
}
