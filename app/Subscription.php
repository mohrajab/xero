<?php

namespace App;

class Subscription extends \Laravel\Spark\Subscription
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
