<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
