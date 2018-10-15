<?php

namespace App\Http\Middleware;

use App\Point;
use App\Service;

class Points
{
    public function handle($request, $next)
    {
        $service = Service::find($request->service_id);
        if (!$service) {
            return $request->ajax() || $request->wantsJson()
                ? response('You should choose the service id', 402)
                : redirect('/settings#/subscription');
        }

        if ($request->user()->currentTeam() && $request->user()->currentTeam()->subscription()) {
            $plan = ($request->user()->currentTeam()->sparkPlan(($request->user()->currentTeam()->subscription()->name)));
            $currentPoints = $request->user()->currentTeam()->points()->where('subscription_team_id', $request->user()->currentTeam()->subscription()->id)->sum('points');
            $planPoints = $plan->__get("points");
            $servicePoints = $service->points;

            if ($currentPoints + $servicePoints <= $planPoints) {
                $result = $next($request);
                $this->deductPoints(
                    $request->user()->id,
                    $service,
                    request()->user()->currentTeam()->id,
                    request()->user()->currentTeam()->subscription()->id
                );
                return $result;
            }
        }

        if ($request->user()->subscription()) {
            $plan = ($request->user()->sparkPlan(($request->user()->subscription()->name)));
            $currentPoints = $request->user()->points()->where('subscription_id', $request->user()->subscription()->id)->sum('points');
            $planPoints = $plan->__get("points");
            $servicePoints = $service->points;

            if ($currentPoints + $servicePoints <= $planPoints) {
                $result = $next($request);
                $this->deductPoints(
                    $request->user()->id,
                    $service,
                    null,
                    null,
                    request()->user()->subscription()->id
                );
                return $result;
            }
        }

        return $request->ajax() || $request->wantsJson()
            ? response('Has no enough points.', 402)
            : redirect('/settings#/subscription');
    }

    private function deductPoints($user_id, $service, $team_id = null, $subscription_team_id = null, $subscription_id = null)
    {
        Point::create([
            "team_id" => $team_id,
            "user_id" => $user_id,
            "points" => $service->points,
            "subscription_team_id" => $subscription_team_id,
            "subscription_id" => $subscription_id,
            "service_id" => $service->id
        ]);
    }
}
