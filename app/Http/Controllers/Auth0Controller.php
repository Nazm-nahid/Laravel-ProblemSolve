<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

class Auth0Controller extends Controller
{

    public $auth0;

    public function __construct()
    {
        $configuration = new SdkConfiguration(
            domain: 'dev-4ynrx4582e1lxsob.us.auth0.com',
            clientId: 'bstwY3SPzqJ9OpVIpVAl1zwKBduzPobD',
            clientSecret: 'gFQkWzjSwfoQh5DNZO5rENnI1s_XwvZdVsy_SwOZwb6GZbsPvNLJuTnkHFlOpr5r',
            cookieSecret: 'pathao#dev',
            redirectUri: "http://127.0.0.1:8000/callback",
        );
        
        $this->auth0 = new Auth0($configuration);
    }

    public function auth0() 
    {
        $session = $this->auth0->getCredentials();

        if (null === $session || $session->accessTokenExpired) {
            // Redirect to Auth0 to authenticate the user.
            header('Location: ' . $this->auth0->login());
            exit;
        }
    }

    public function callback(Request $request) 
    {
        $input = $request->all();

        if (null !== $this->auth0->getExchangeParameters()) {
            $this->auth0->exchange();
        }

        $user = $this->auth0->getCredentials()?->user;

        dd($user);
    }
}
