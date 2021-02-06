<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => 'Api',
    'prefix' => 'v1',
], function () {

    /*
    |--------------------------------------------------------------------------
    | Shared Endpoints
    |--------------------------------------------------------------------------
    */
    // AUTH
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('register', 'RegisterController@register');
//        Route::post('resend-email-verification', 'VerifyController@resendEmailVerification');
//        Route::post('verify-email', 'VerifyController@verifyEmail');
        Route::post('resend-phone-verification', 'VerifyController@resendPhoneVerification');
        Route::post('verify-phone', 'VerifyController@verifyPhone');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->middleware('auth:api');
    });
    // Locations
    Route::group(['namespace' => 'Location', 'prefix' => 'locations'], function () {
        Route::get('countries', 'CountryController@index');
        Route::get('countries/{countryId}/cities', 'CountryCityController@index');
        Route::get('cities', 'CityController@index');
    });
    // General
    Route::group(['namespace' => 'General', 'prefix' => 'general'], function () {
        Route::get('intro-slides', 'AppIntroSlideController@index');
        Route::get('car-brands', 'CarBrandController@index');
        Route::get('car-brands/{carBrand}/models', 'CarBrandController@fetchModels');
        Route::get('part-categories', 'PartCategoryController@index');


        Route::post('upload-excel', 'PageController@uploadExcel');
    });
    // Pages
    Route::group(['namespace' => 'General', 'prefix' => 'pages'], function () {
        Route::get('terms', 'PageController@terms');
        Route::get('privacy', 'PageController@privacy');
    });
    // Help
    Route::group(['namespace' => 'General\Help', 'prefix' => 'help'], function () {
        Route::get('problem-types', 'ProblemTypeController@index');
        Route::post('reported-problems', 'ReportedProblemController@store');
        Route::post('contact-messages', 'ContactMessageController@store');
    });
    // ForgotPassword
    Route::group(['prefix' => 'password', 'namespace' => 'Auth', 'middleware' => 'guest'], function () {
        Route::post('forgot', 'ResetPasswordController@forgotPassword');
        Route::post('resend', 'ResetPasswordController@resend');
        Route::post('token', 'ResetPasswordController@checkToken');
        Route::post('set', 'ResetPasswordController@setNewPassword');
    });

    // AuthCustomer
    Route::group([
        'prefix' => 'auth-customer',
        'namespace' => 'Customer',
        'middleware' => ['auth:api'],
    ], function () {

        Route::group(['prefix' => 'settings'], function () {
            Route::post('/', 'SettingController@updateProfile');
            Route::put('password', 'SettingController@updatePassword');
            //Route::put('phone', 'SettingController@updatePhone');
            Route::post('upload-avatar', 'SettingController@uploadAvatar');
        });

        Route::group(['prefix' => 'cars'], function () {
            Route::get('/', 'CarController@index');
            Route::get('{car}', 'CarController@show');
            Route::post('/', 'CarController@store');
            Route::post('{car}', 'CarController@update');
            Route::delete('{car}', 'CarController@destroy');
        });

        Route::group(['prefix' => 'addresses'], function () {
            Route::get('/', 'AddressController@index');
            Route::get('{address}', 'AddressController@show');
            Route::post('/', 'AddressController@store');
            Route::put('{address}', 'AddressController@update');
            Route::delete('{address}', 'AddressController@destroy');
        });
    });


    Route::group([
        'namespace' => 'Product',
        'middleware' => ['auth:api'],
    ], function () {

        Route::group(['prefix' => 'parts'], function () {
            Route::get('/', 'PartController@index');
            Route::get('{part}', 'PartController@show');
        });

        Route::group(['prefix' => 'accessories'], function () {
            Route::get('/', 'AccessoryController@index');
            Route::get('{accessory}', 'AccessoryController@show');
        });
    });

});
