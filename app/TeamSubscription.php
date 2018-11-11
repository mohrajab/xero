<?php

namespace App;

class TeamSubscription extends \Laravel\Spark\TeamSubscription
{
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
