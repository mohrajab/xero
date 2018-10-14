<?php

namespace App;

use Laravel\Spark\CanJoinTeams;
use Laravel\Spark\User as SparkUser;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Model|null $current_team
 * @property-read string|null $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Invitation[] $invitations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $ownedTeams
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Point[] $points
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Subscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Token[] $tokens
 * @mixin \Eloquent
 */
class User extends SparkUser
{
    use CanJoinTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];

    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
