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
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property bool $uses_two_factor_auth
 * @property string|null $authy_id
 * @property string|null $country_code
 * @property string|null $phone
 * @property string|null $two_factor_reset_code
 * @property int|null $current_team_id
 * @property string|null $stripe_id
 * @property string|null $current_billing_plan
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $card_country
 * @property string|null $billing_address
 * @property string|null $billing_address_line_2
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string|null $billing_zip
 * @property string|null $billing_country
 * @property string|null $vat_id
 * @property string|null $extra_billing_information
 * @property \Illuminate\Support\Carbon|null $trial_ends_at
 * @property string|null $last_read_announcements_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAuthyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBillingAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCurrentBillingPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereExtraBillingInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastReadAnnouncementsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTwoFactorResetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsesTwoFactorAuth($value)
 * @method static \Illuminate\Dat0.abase\Eloquent\Builder|\App\User whereVatId($value)
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
