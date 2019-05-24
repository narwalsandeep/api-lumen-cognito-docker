<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Constants as C;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new CognitoController();
        $this->cognito = $this->client->getClient();
    }

    /**
     *
     * @return unknown
     */
    public function read(\Illuminate\Http\Request $request, $username)
    {
        $this->payload = [];
        try {
            $response = $this->cognito->getUser($username);
            $this->payload = $username;
            return $this->make(true, C::SUCC_LOADED_SUCCESSFULLY);
        } catch (\pmill\AwsCognito\Exception\UserNotFoundException $e) {
            return $this->make(false, C::ERR_USER_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->make(false, C::ERR_UNKNOWN_ERROR);
        }
    }

    /**
     *
     * @return unknown
     */
    public function delete(\Illuminate\Http\Request $request)
    {
        $x = $request->input();
        $this->payload = [];
        if ($this->_verifyAuth($x['token'])) {
            try {
                $response = $this->cognito->deleteUser($x['token']);
                $this->payload = $response;
                return $this->make(true, C::SUCC_DELETED_SUCCESSFULLY);
            } catch (\Exception $e) {
                return $this->make(false, C::ERR_UNKNOWN_ERROR);
            }
        }
        else{
            return $this->make(false, C::ERR_INVALID_TOKEN);
        }
    }

    /**
     *
     */
    public function _verifyAuth($token)
    {
        try {
            $res = $this->cognito->verifyAccessToken($token);
            return $res;
        } catch (\Exception $e) {
            return false;
        }
    }
}
