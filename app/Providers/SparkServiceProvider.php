<?php

namespace App\Providers;

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
        'mohammed.r.rajab@gmail.com',
        'devmsh87@gmail.com',
        'moh.rajab@dce.sa'
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
        Spark::useStripe()->noCardUpFront()->teamTrialDays(2);
        Spark::useStripe()->noCardUpFront()->trialDays(3);

        Spark::checkPlanEligibilityUsing(function ($user, $plan) {
            return true;
            if ($plan->__get("points") > 1) {
                return false;
            }

            return true;
        });

        Spark::plan('Basic', 'plan_DjfmlqQ1K5uGAi')
            ->price(50)
            ->features([
                '100 point', 'Arabic PDF', 'One month validity'
            ])->attributes(["points" => 100]);

        Spark::teamPlan('Basic Team', 'plan_Dmnva2WkQH8d4V')
            ->price(50)
            ->features([
                '200 point', 'Arabic PDF', 'One month validity', 'Team usage'
            ])->attributes(["points" => 200]);

        Spark::plan('Pro', 'plan_DlhQTSTTgUxlLN')
            ->price(100)
            ->features([
                '300 point', 'Arabic PDF', 'One month validity'
            ])->attributes(["points" => 300]);
    }
}
