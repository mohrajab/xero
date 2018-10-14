<?php

namespace App\Http\Middleware;

class HasEnoughPoints
{
    public function handle($request, $next)
    {
        $plan = ($request->user()->sparkPlan(($request->user()->subscription()->name)));
        $currentPoints = $request->user()->points()->where('subscription_id', $request->user()->subscription()->id)->sum('points');
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
