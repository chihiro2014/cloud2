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

Route::get('/', function () {
    return view('index');
});


// Auth Routes
Route::group(['prefix' => config('yeelight.backend.route.prefix'), 'namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::any('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

// Console Routes
Route::group(['prefix' => config('yeelight.backend.route.prefix'), 'namespace' => config('yeelight.backend.route.namespace')], function ($router) {

    $router->get('index','HomeController@index');
    $router->get('/', function () {
        return view('console.index');
    });

    $router->get('/i18n', 'ConsoleController@dataTableI18n');

    // 权限
    //require(__DIR__ . '/console/permission.php');


    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


});

// Mobile Routes
Route::group(['prefix' => config('yeelight.mobile.route.prefix'), 'namespace' => config('yeelight.mobile.route.namespace')], function () {

    // Mobile App
    Route::get('/', 'MobileController@getIndex');

    Route::get('/app', 'MobileController@getApp');

    // Protected Routes
    Route::group(['middleware' => 'auth'], function () {

        Route::get('users', 'UserController@getUserList');

        Route::get('users/{id}', 'UserController@getUserDetail');

    });

});

// Basic Routes
//Route::get('/home', 'HomeController@index');

// Protected Routes
Route::group(['middleware' => 'auth'], function () {

//    Route::get('/', function () {
//        return redirect('users');
//    });

    //Route::get('/', 'ExampleController@getIndexExample');
    Route::get('blank-example', 'ExampleController@getBlankExample');
    Route::get('desktop-example', 'ExampleController@getDesktopExample');

    Route::get('users', 'UserController@getUserList');

});

// Image Routes
// @WARNING: The 'image' prefix is reserved for SomelineImageService
Route::group(['prefix' => 'image'], function () {

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/', 'ImageController@postImage');
    });

    Route::get('{type}/{name}', 'ImageController@showTypeImage');
    Route::get('/{name}', 'ImageController@showOriginalImage');

});

// Locale Routes
// @WARNING: The 'locales' prefix is reserved for YeelightLocaleController
Route::group(['prefix' => 'locales'], function () {

    Route::get('/{locale}.js', '\Yeelight\Services\Locale\Controllers\LocaleController@getLocaleJs');

    Route::get('/switch/{locale}', '\Yeelight\Services\Locale\Controllers\LocaleController@getSwitchLocale');

});