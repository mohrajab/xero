<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Service;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;

class WelcomeController extends Controller
{
    /**
     * Show the application splash screen.
     *
     * @return Response
     */
    public function show()
    {
        foreach (Service::all() as $item) {
            $item->created_at = now();
            $item->save();
        }

        $tags = Tag::all();
        $services = Service::with('tags')->get();

        return view('welcome', compact('services', 'tags'));
    }

    public function service(Service $service)
    {
        return view('service', compact('service'));
    }
}
