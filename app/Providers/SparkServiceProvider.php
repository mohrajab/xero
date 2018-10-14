<?php

namespace App\Providers;

use App\Team;
use App\User;
use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Xero',
        'product' => 'Arabic PDF',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'mohammed.r.rajab@gmail.com'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = false;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::useStripe()->noCardUpFront()->teamTrialDays(7);
        Spark::useStripe()->noCardUpFront()->trialDays(7);

        Spark::checkPlanEligibilityUsing(function ($user, $plan) {
            return true;
            if ($plan->__get("points") > 1) {
                return false;
            }

            return true;
        });

        /*Spark::chargePerSeat('Points', function (User $user) {
            if ($user->subscription()->valid())
                return $user->points()->where('subscription_id', $user->subscription()->id)->count();
            return 0;
        });

        Spark::chargesTeamsPerSeat('Points', function (Team $team) {
            if ($team->subscription()->valid())
                return $team->points()->where('subscription_id', $team->subscription()->id)->count();
            return 0;
        });*/

        Spark::plan('Basic', 'plan_DjfmlqQ1K5uGAi')
            ->price(50)
            ->features([
                'First', 'Second', 'Third'
            ])->attributes(["points" => 100]);

        Spark::teamPlan('Basic Team', 'plan_DkxOJBoCeCm1qQaa')
            ->price(50)
            ->features([
                'First', 'Second', 'Third'
            ])->attributes(["points" => 200]);

        Spark::plan('Pro', 'plan_DlhQTSTTgUxlLN')
            ->price(100)
            ->features([
                'First', 'Second', 'Third'
            ])->attributes(["points" => 10]);
    }
}
