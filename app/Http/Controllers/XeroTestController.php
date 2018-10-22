<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use XeroPHP\Application\PublicApplication;
use XeroPHP\Models\Accounting\Invoice;
use XeroPHP\Remote\Request;
use XeroPHP\Remote\URL;

class XeroTestController extends Controller
{

    private $xero;

    public function __construct()
    {
        $this->xero = new PublicApplication(config('xero'));
    }

    public function test()
    {
        Session::remove('oauth');

        // if no session or if it is expired
        if (!Session::has('oauth') || !Session::get('oauth')) {
            var_dump('qwe');
            Config::set('xero.oauth.callback', \Illuminate\Support\Facades\Request::fullUrl());
            $this->xero = new PublicApplication(config('xero'));

            $request = new Request($this->xero, new URL($this->xero, URL::OAUTH_REQUEST_TOKEN));
            $request->send();

            $oauth_response = $request->getResponse()->getOAuthResponse();

            $this->setOAuthSession(
                $oauth_response['oauth_token'],
                $oauth_response['oauth_token_secret'],
                null
            );

            return Redirect::to($this->xero->getAuthorizeURL($oauth_response['oauth_token']));
        } else {
            var_dump('qwe1');
            $this->xero->getOAuthClient()
                ->setToken(Session::get('oauth.token'))
                ->setTokenSecret(Session::get('oauth.token_secret'));

            if (request()->has('oauth_verifier')) {
                $this->xero->getOAuthClient()->setVerifier(request('oauth_verifier'));
                $request = new Request($this->xero, new URL($this->xero, URL::OAUTH_ACCESS_TOKEN));
                $request->send();
                $oauth_response = $request->getResponse()->getOAuthResponse();

                $this->setOAuthSession(
                    $oauth_response['oauth_token'],
                    $oauth_response['oauth_token_secret'],
                    $oauth_response['oauth_expires_in']
                );

                $this->xero->getOAuthClient()
                    ->setToken(Session::get('oauth.token'))
                    ->setTokenSecret(Session::get('oauth.token_secret'));
            }
        }
        var_dump('qwe2');
        //Otherwise, you're in.
    }

    public function invoice()
    {
        if ($val = $this->test())
            return $val;

        dd($this->xero->load(Invoice::class)->execute());
    }

    /**
     * @param $token
     * @param $secret
     * @param $expires
     */
    public function setOAuthSession($token, $secret, $expires = null)
    {
        // expires sends back an int
        if ($expires !== null) {
            $expires = time() + intval($expires);
        }

        Session::put('oauth', [
            'token' => $token,
            'token_secret' => $secret,
            'expires' => $expires,
        ]);

        Session::save();

    }

    /**
     * @return mixed
     */
    public function getOAuthSession()
    {
        //If it doesn't exist or is expired, return null
        if (!empty(Session::get('oauth')) || Session::get('oauth.expires') !== null && Session::get('oauth.expires') <= time()) {
            return null;
        }

        return Session::get('oauth');
    }
}
