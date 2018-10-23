<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use XeroPHP\Application\PublicApplication;
use XeroPHP\Remote\Request;
use XeroPHP\Remote\URL;

class XeroAuthController extends Controller
{

    private $xero;

    public function __construct()
    {
        $this->xero = new PublicApplication(config('xero'));
    }

    public function login()
    {
//        Session::remove('oauth');
        // if no session or if it is expired
        if (!$this->getOAuthSession()) {
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

        if ($go_to = Session::pull('back_to'))
            return \redirect($go_to);
        else
            return \redirect('home');
        //Otherwise, you're in.
    }

    /**
     * @param $token
     * @param $secret
     * @param $expires
     */
    private function setOAuthSession($token, $secret, $expires = null)
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
}
