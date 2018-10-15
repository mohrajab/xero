<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Point
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $team_id
 * @property int $user_id
 * @property int $points
 * @property int|null $subscription_id
 * @property int|null $subscription_team_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereSubscriptionTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereUserId($value)
 */
class Point extends Model
{
    protected $fillable = ['team_id', 'user_id', 'points', 'subscription_id', 'service_id', 'subscription_team_id'];
}
