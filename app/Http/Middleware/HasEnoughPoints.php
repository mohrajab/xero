<?php

namespace App\Http\Middleware;

use Laravel\Spark\Plan;

class HasEnoughPoints
{
    public function handle($request, $next, $subscription = 'default', Plan $plan = null)
    {
        $currentPoints = $request->user->points()->where('subscription_id', $subscription->id)->count();
        $planPoints = $plan->__get("points");
        $servicePoints = $request->service->points;
        if ($currentPoints + $servicePoints <= $planPoints) {
            return $next($request);
        }

        return $request->ajax() || $request->wantsJson()
            ? response('Has no enough points.', 402)
            : redirect('/settings#/subscription');
    }
}
