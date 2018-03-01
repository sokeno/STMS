<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
       
    });

    $api->group(['prefix' => 'api', 'middleware' => ['ability:admin,create-users']], function($api){
        // Protected route
        $api->get('users', 'App\\Api\\V1\\Controllers\\UserController@index');
        });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
    $api->group(['middleware' => 'api.auth'], function ($api) {
	//$api->post('task/store', 'App\Api\V1\Controllers\TaskController@store');
    //$api->get('task', 'App\Api\V1\Controllers\TaskController@index');
    
	//$api->get('task/{id}', 'App\Api\V1\Controllers\TaskController@show');
	
	//$api->put('task/{id}', 'App\Api\V1\Controllers\TaskController@update');
    //$api->delete('task/{id}', 'App\Api\V1\Controllers\TaskController@destroy');
    
    $api->resource('task', 'App\Api\V1\Controllers\TaskController');
    $api->resource('note', 'App\Api\V1\Controllers\NoteController');
     
    $api->get('users', 'App\\Api\\V1\\Controllers\\UserController@index');
    $api->post('role', 'App\\Api\\V1\\Controllers\\LoginController@createRole');
    $api->post('permission', 'App\\Api\\V1\\Controllers\\LoginController@createPermission');
    $api->post('attach-permission', 'App\\Api\\V1\\Controllers\\LoginController@attachPermission');
    $api->post('assign-role', 'App\\Api\\V1\\Controllers\\LoginController@assignRole');
  
});

});
