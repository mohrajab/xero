<?php

namespace App\Http\Controllers;

use App\Point;
use App\Service;

class ServiceController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Service $service)
    {
        Point::create([
            "user_id" => request()->user()->id,
            "points" => $service->points,
            "subscription_id" => request()->user()->subscription()->id,
            "service_id" => $service->id
        ]);

        // TODO: here you should YASSIR fire the code he want to implement
        return 'done';
    }
}
