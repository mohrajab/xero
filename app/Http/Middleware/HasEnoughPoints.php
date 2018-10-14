<?php

namespace App\Http\Middleware;

class HasEnoughPoints
{
    public function handle($request, $next)
    {
        //dd($request->user()->subscription());
        if ($request->user()->currentTeam() && $request->user()->currentTeam()->subscription()) {
            $plan = ($request->user()->currentTeam()->sparkPlan(($request->user()->currentTeam()->subscription()->name)));
            $currentPoints = $request->user()->currentTeam()->points()->where('subscription_team_id', $request->user()->currentTeam()->subscription()->id)->sum('points');
            $planPoints = $plan->__get("points");
            $servicePoints = $request->service->points;

            if ($currentPoints + $servicePoints <= $planPoints) {
                return $next($request);
            }
        }

        if ($request->user()->subscription()) {
            $plan = ($request->user()->sparkPlan(($request->user()->subscription()->name)));
            $currentPoints = $request->user()->points()->where('subscription_id', $request->user()->subscription()->id)->sum('points');
            $planPoints = $plan->__get("points");
            $servicePoints = $request->service->points;

            if ($currentPoints + $servicePoints <= $planPoints) {
                return $next($request);
            }
        }

        return $request->ajax() || $request->wantsJson()
            ? response('Has no enough points.', 402)
            : redirect('/settings#/subscription');
    }
}
