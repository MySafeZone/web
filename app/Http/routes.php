<?php

Route::get('/decrypt/{bag}',  ['uses' => 'BagController@decrypt', 'as' => 'bag.decrypt']);

Route::group(
    ['middleware' => 'web'], function () {

        Route::get('/', 'HomeController@index');

        Route::auth();

        // Settings
        Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings.index']);
        Route::patch('settings/user/email', ['uses' => 'SettingsController@updateEmail', 'as' => 'settings.updateemail']);
        Route::patch('settings/user/password', ['uses' => 'SettingsController@updatePassword', 'as' => 'settings.updatepassword']);
        Route::patch('settings/user/coercionpassword', ['uses' => 'SettingsController@updateCoercionPassword', 'as' => 'settings.updatecoercionpassword']);
        Route::post('settings/user/two-factor', ['uses' => 'SettingsController@enableTwoFactorAuth', 'as' => 'settings.enable_2fa']);
        Route::delete('settings/user/two-factor', ['uses' => 'SettingsController@disableTwoFactorAuth', 'as' => 'settings.disable_2fa']);

        // Bag
        Route::resource('bag', 'BagController');
        Route::get('/home', 'BagController@index');

        Route::get('bag/{bag}/delete', ['uses' => 'BagController@checkDelete', 'as' => 'bag.checkdelete']);

        Route::get('bag/{bag}/send', ['uses' => 'BagController@checkSend', 'as' => 'bag.checksend']);
        Route::post('bag/{bag}/send', ['uses' => 'BagController@send', 'as' => 'bag.send']);

        Route::get('bag/{bag}/disable', ['uses' => 'BagController@checkDisable', 'as' => 'bag.checkdisable']);
        Route::patch('bag/{bag}/disable', ['uses' => 'BagController@disable', 'as' => 'bag.disable']);

        Route::get('bag/{bag}/enable', ['uses' => 'BagController@checkEnable', 'as' => 'bag.checkenable']);
        Route::patch('bag/{bag}/enable', ['uses' => 'BagController@enable', 'as' => 'bag.enable']);

        // Leter
        Route::resource('leter', 'LeterController');

        Route::get('leter/{leter}/delete', ['uses' => 'LeterController@checkDelete', 'as' => 'leter.checkdelete']);

        // Markdown
        Route::get('terms', ['uses' => 'MarkdownController@terms', 'as' => 'terms']);
        Route::get('privacy', ['uses' => 'MarkdownController@privacy', 'as' => 'privacy']);
    }
);

Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {
    Route::post('signin', ['uses' => 'ApiController@signin']);
});

Route::get("api/randomApiToken", ['uses' => 'ApiController@randomApiToken']);
