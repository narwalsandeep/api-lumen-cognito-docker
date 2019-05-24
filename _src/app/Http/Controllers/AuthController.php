<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Constants as C;

class AuthController extends Controller
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
    public function signup(\Illuminate\Http\Request $request)
    {
        $x = $request->input();
        $_r = $this->_validateSignup($x);
        if (!$_r['success']) {
            return $this->make(false, $_r['msg']);
        }

        try {
            $response = $this->cognito->registerUser($x['username'], $x['password'], [
                'email' => $x['username'],
            ]);
            $this->payload = $response;
            return $this->make(true, C::SUCC_CREATED_SUCCESSFULLY);

        } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {
            return $this->make(false, C::ERR_CHECK_USERNAME_OR_PASSWORD);
        } catch (\pmill\AwsCognito\Exception\UsernameExistsException $e) {
            return $this->make(false, C::ERR_USER_EXISTS);
        } catch (\InvalidArgumentException $e) {
            return $this->make(false, C::ERR_CHECK_USERNAME_OR_PASSWORD);
        } catch (\Exception $e) {
            return $this->make(false, C::ERR_UNKNOWN_ERROR);
        }
    }

    /**
     *
     * @return unknown
     */
    public function confirmUser(\Illuminate\Http\Request $request)
    {
        $x = $request->input();

        try {
            $this->cognito->confirmUserRegistration($x['code'], $x['username']);
            return $this->make(true, C::SUCC_CREATED_SUCCESSFULLY_AND_CONFIRMED);
        } catch (\pmill\AwsCognito\Exception\CodeMismatchException $e) {
            return $this->make(false, C::ERR_INVALID_VERIFICATION_CODE);
        } catch (\Exception $e) {
            return $this->make(false, C::ERR_UNKNOWN_ERROR);
        }
    }

    /**
     *
     * @return unknown
     */
    public function signin(\Illuminate\Http\Request $request)
    {
        $x = $request->input();
        $_r = $this->_validateSignin($x);
        if (!$_r['success']) {
            return $this->make(false, $_r['msg']);
        }

        try {
            $response = $this->cognito->authenticate($x['username'], $x['password']);
            $data = $response;
            $this->payload = $data;
            return $this->make(true, C::SUCC_UPDATED_SUCCESSFULLY);
        } catch (\Exception $e) {
            return $this->make(false, C::ERR_INVALID_USER_PWD);
        }
    }

    /**
     *
     * @return unknown
     */
    public function changePassword(\Illuminate\Http\Request $request)
    {
        $x = $request->input();
        $this->payload = [];
        if ($this->_verifyAuth($x['token'])) {
            $_r = $this->_validateChangePassword($x);
            if (!$_r['success']) {
                return $this->make(false, $_r['msg']);
            }
            try {
                $this->cognito->changePassword($x['token'], $x['old_password'], $x['new_password']);
                return $this->make(true, C::SUCC_UPDATED_SUCCESSFULLY);
            } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {
                return $this->make(false, C::ERR_INVALID_USER_PWD);
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
     * @return unknown
     */
    public function resetPassword(\Illuminate\Http\Request $request)
    {
        $x = $request->input();
        $this->payload = [];

        try {
            $response = $this->cognito->resetPassword($x['code'],$x['username'],$x['new_password']);
            return $this->make(true, C::SUCC_UPDATED_SUCCESSFULLY);
        } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {
            return $this->make(false, C::ERR_INVALID_DATA);
        } catch (\Exception $e) {
            return $this->make(false, C::ERR_UNKNOWN_ERROR);
        }
    }

    /**
     *
     * @return unknown
     */
    public function forgotPassword(\Illuminate\Http\Request $request)
    {
        $x = $request->input();
        $this->payload = [];

        try {
            $response = $this->cognito->sendForgottenPasswordRequest($x['username']);
            return $this->make(true, C::SUCC_UPDATED_SUCCESSFULLY);
        } catch (\pmill\AwsCognito\Exception\UserNotFoundException $e) {
            return $this->make(false, C::ERR_USER_NOT_FOUND);
        } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {
            return $this->make(false, C::ERR_USER_NOT_VERIFIED);
        } catch (\Exception $e) {
            return $this->make(false, C::ERR_UNKNOWN_ERROR);
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

    /**
     *
     */
    public function _validateSignup($x)
    {
        return array("success" => true, "msg" => "");
    }

    /**
     *
     */
    public function _validateSignin($x)
    {
        return array("success" => true, "msg" => "");
    }

    /**
     *
     */
    public function _validateSignout($x)
    {
        return array("success" => true, "msg" => "");
    }

    /**
     *
     */
    public function _validateChangePassword($x)
    {
        return array("success" => true, "msg" => "");

    }
}
