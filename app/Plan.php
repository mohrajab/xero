<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spark;

/**
 * App\Plan
 *
 * @property int $id
 * @property string $name
 * @property string $interval
 * @property bool $team_plan
 * @property string $plan_id
 * @property float $price
 * @property int $points
 * @property array $features
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereTeamPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
