<?php

namespace App\Http\Controllers;

use App\Point;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Service $service)
    {
        dd("aaxxx");
        Point::create([
            ""
        ]);
    }
}
