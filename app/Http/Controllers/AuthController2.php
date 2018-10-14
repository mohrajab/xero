<?php

namespace App\Http\Controllers;

use XeroPHP\Application\PrivateApplication;
use XeroPHP\Application\PublicApplication;
use XeroPHP\Models\Accounting\Invoice;
use XeroPHP\Remote\Request;
use XeroPHP\Remote\URL;

class AuthController2 extends Controller
{
    protected $xero;

    public function __construct(PublicApplication $xero)
    {
        $this->xero = $xero;
    }

    public function access()
    {
        ini_set('memory_limit', '-1');
        //if no session or if it is expired
        $oauth_session = $this->getOAuthSession();

        if (null === $oauth_session) {
            $url = new URL($this->xero, URL::OAUTH_REQUEST_TOKEN);
            $request = new Request($this->xero, $url);
            //Here's where you'll see if your keys are valid.
            //You can catch a BadRequestException.
            try {
                $request->send();
            } catch (\Exception $e) {
                print_r($e);
                if ($request->getResponse()) {
                    print_r($request->getResponse()->getOAuthResponse());
                }
            }
            $oauth_response = $request->getResponse()->getOAuthResponse();
            $this->setOAuthSession(
                $oauth_response['oauth_token'],
                $oauth_response['oauth_token_secret']
            );

            return \Redirect::to($this->xero->getAuthorizeURL($oauth_response['oauth_token']));
        } else {
            $this->xero->getOAuthClient()
                ->setToken($oauth_session['token'])
                ->setTokenSecret($oauth_session['token_secret']);
            if (request()->has('oauth_verifier')) {
                $this->xero->getOAuthClient()->setVerifier(request('oauth_verifier'));
                $url = new URL($this->xero, URL::OAUTH_ACCESS_TOKEN);
                $request = new Request($this->xero, $url);
                $request->send();
                $oauth_response = $request->getResponse()->getOAuthResponse();
                $this->setOAuthSession(
                    $oauth_response['oauth_token'],
                    $oauth_response['oauth_token_secret'],
                    $oauth_response['oauth_expires_in']
                );
            }
        }
    }


    public function test()
    {
        $this->access();

        dd($this->xero->load(Invoice::class)->execute());
    }

    private function setOAuthSession($token, $secret, $expires = null)
    {
        if ($expires !== null) {
            $expires = time() + intval($expires);
        }

        session()->put('oauth', [
            'token' => $token,
            'token_secret' => $secret,
            'expires' => $expires
        ]);
    }

    private function getOAuthSession()
    {
        if (!session()->has('oauth') ||
            (session()->get('oauth.expires') !== null && session()->get('oauth.expires') <= time())
        ) {
            return null;
        }

        return session()->get('oauth');
    }
}
