<?php

namespace App\Http\Controllers;

class CognitoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function config()
    {
        return [
            'credentials' => [
                'key' => env("AWS_KEY"),
                'secret' => env("AWS_SECRET"),
            ],
            'region' => env("AWS_REGION"),
            'version' => env("AWS_VERSION"),
            'app_client_id' => env("AWS_APP_CLIENT_ID"),
            'app_client_secret' => env("AWS_APP_CLIENT_SECRET"),
            'user_pool_id' => env("AWS_USER_POOL_ID")
        ];
    }

    /**
     *
     * @return void
     */
    public function getClient()
    {
        $config = $this->config();
        $aws = new \Aws\Sdk($config);
        $cognitoClient = $aws->createCognitoIdentityProvider();
        $client = new \pmill\AwsCognito\CognitoClient($cognitoClient);
        $client->setAppClientId($config['app_client_id']);
        $client->setAppClientSecret($config['app_client_secret']);
        $client->setRegion($config['region']);
        $client->setUserPoolId($config['user_pool_id']);
        return $client;
    }



}
