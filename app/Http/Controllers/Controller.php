<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return mixed
     */
    protected function getOAuthSession()
    {
        //If it doesn't exist or is expired, return null
        if (!Session::has('oauth') || (Session::get('oauth.expires') && Session::get('oauth.expires') <= time())) {
            Session::remove('oauth');
            Session::save();
            return null;
        }

        return Session::get('oauth');
    }
}
