<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

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
    return view('welcome');
});

Route::view('chat-frame', 'chat-frame');
Route::post('test', function() {
    $config = [
        // Your driver-specific configuration
        'facebook' => [
            'token' => env('FACEBOOK_TOKEN'),
            'app_secret' => env('FACEBOOK_VERIFICATION'),
            'verification' => env('FACEBOOK_APP_SECRET'),
        ]
    ];
    
    DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
    // create an instance
    $botman = BotManFactory::create($config);
    
    // give the bot something to listen for.
    $botman->hears('hello', function (BotMan $bot) {
        $bot->reply('Hello yourself.');
    });
    $botman->fallback(function($bot) {
        $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
    });
    // start listening
    $botman->listen();
});