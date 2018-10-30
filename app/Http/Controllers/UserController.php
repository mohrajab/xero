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
        if (auth()->user()->subscription())
            $user->current_points = auth()->user()->points()->where('subscription_id', auth()->user()->subscription()->id)->sum('points') . "/" . (auth()->user()->sparkPlan((auth()->user()->subscription()->name)))->__get('points');

        if (auth()->user()->currentTeam() && auth()->user()->currentTeam()->subscription())
            $user->current_points = auth()->user()->currentTeam()->points()->where('subscription_team_id', auth()->user()->currentTeam()->subscription()->id)->sum('points') . "/" . (auth()->user()->currentTeam()->sparkPlan((auth()->user()->currentTeam()->subscription()->name)))->__get('points');

        return response(["data" => \Auth::user()]);
    }

    public function services()
    {
        return response(["data" => Service::all()]);
    }

}
