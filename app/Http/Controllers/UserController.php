<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = \Auth::user();
        return response(["data" => \Auth::user()]);
    }

    public function services()
    {
        return response(["data" => Service::all()]);
    }

}
