<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version()." <br>".__FILE__;
});

$router->get ( 'test', [ 
	'uses' => "TestController@run" 
] );

/**
 * CRUD style
 */

 /**
 * AUTH CONTROLLER
 */
// signup
$router->post ( 'auth', [ 
	'uses' => "AuthController@signup" 
] );
// signin
$router->put ( 'auth', [ 
	'uses' => "AuthController@signin" 
] );
// signout
$router->delete ( 'auth', [ 
	'uses' => "AuthController@signout" 
] );
// confirm user
$router->put ( 'auth/confirm-user', [ 
	'uses' => "AuthController@confirmUser" 
] );
// change password
$router->put ( 'auth/change-password', [ 
	'uses' => "AuthController@changePassword" 
] );
// forgot password
$router->put ( 'auth/forgot-password', [ 
	'uses' => "AuthController@forgotPassword" 
] );
// reset password
$router->put ( 'auth/reset-password', [ 
	'uses' => "AuthController@resetPassword" 
] );



/**
 * USER CONTROLLER
 */
$router->get( 'user/{username}', [ 
	'uses' => "UserController@read" 
] );
$router->delete( 'user', [ 
	'uses' => "UserController@delete" 
] );


