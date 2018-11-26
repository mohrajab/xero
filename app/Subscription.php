<?php

namespace App;

/**
 * App\Subscription
 *
 * @property int $id
 * @property int $user_id
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
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUserId($value)
 * @mixin \Eloquent
 */
class Subscription extends \Laravel\Spark\Subscription
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
