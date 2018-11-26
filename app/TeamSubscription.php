<?php

namespace App;

/**
 * App\TeamSubscription
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_plan
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $trial_ends_at
 * @property \Illuminate\Support\Carbon|null $ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $provider_plan
 * @property-read \App\User $owner
 * @property-read \App\Team $team
 * @property-read \App\Team $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TeamSubscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TeamSubscription extends \Laravel\Spark\TeamSubscription
{
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
