<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::group([/*'middleware' => 'auth:api'*/], function () {
        Route::post('/topic/create', 'TopicController@create')->name('api.topic_create');
        Route::post('/publish/{topic}', 'TopicController@publish')->name('api.topic_publish');
    });

    Route::post('/subscribe/{topic}', 'SubscriberController@subscribe')->name('api.subscriber_subscribe');
});

