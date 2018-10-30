<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = \Auth::user();
        $user->current_points = "0/0";
        $user->current_active = "personal";
        if ($user->subscription())
            $user->current_points = $user->points()->where('subscription_id', $user->subscription()->id)->sum('points') . "/" . ($user->sparkPlan(($user->subscription()->name)))->__get('points');

        if ($user->currentTeam() && $user->currentTeam()->subscription()) {
            $user->current_points = $user->currentTeam()->points()->where('subscription_team_id', $user->currentTeam()->subscription()->id)->sum('points') . "/" . ($user->currentTeam()->sparkPlan(($user->currentTeam()->subscription()->name)))->__get('points');
            $user->current_active = $user->currentTeam()->name;
        }

        return response(["data" => \Auth::user()]);
    }

    public function services()
    {
        return response(["data" => Service::all()]);
    }

}
