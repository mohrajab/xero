<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spark;

class Plan extends Model
{
    protected $attributes = [
        'interval' => 'monthly'
    ];

    protected $casts = [
        'features' => 'array',
        'team_plan' => 'boolean',
    ];

    public static function loadSpark()
    {
        foreach (self::all() as $plan) {

            $sparkPlan = $plan->team_plan ?
                Spark::teamPlan($plan->name, $plan->plan_id) :
                Spark::plan($plan->name, $plan->plan_id);

            $sparkPlan->price($plan->price)->features([
                '100 point', 'Arabic PDF', 'One month validity'
            ])->attributes(["points" => $plan->points]);

            if ($plan->interval == "yearly") {
                $sparkPlan->yearly();
            }
        }

    }
}
