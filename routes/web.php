<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
    // implement your reset password route here!
}]);

Route::get('/', function () {
    return view('index');
});
// Route to create a new role
Route::post('role', 'App\\Api\\V1\\Controllers\\LoginController@createRole');
// Route to create a new permission
Route::post('permission', 'App\\Api\\V1\\Controllers\\LoginController@createPermission');
// Route to assign role to user
Route::post('assign-role', 'App\\Api\\V1\\Controllers\\LoginController@assignRole');
// Route to attache permission to a role
Route::post('attach-permission', 'App\\Api\\V1\\Controllers\\LoginController@attachPermission');

// API route group that we need to protect
Route::group(['prefix' => 'api', 'middleware' => ['ability:admin,create-users']], function()
{
    // Protected route
    Route::get('users', 'App\\Api\\V1\\Controllers\\UserController@index');
});

// Authentication route
Route::post('authenticate', 'App\\Api\\V1\\Controllers\\LoginController@login');