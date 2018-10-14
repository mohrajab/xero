<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['team_id', 'user_id', 'points', 'subscription_id', 'service_id', 'subscription_team_id'];
}
