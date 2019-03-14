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
use Twilio\Rest\Client;

Route::get('/', function () {
    return view('welcome');
});


Route::get('sendmessage', function() {
    $sid    = env("TWILIO_ACCOUNT_SID");
    $token  = env("TWILIO_AUTH_TOKEN");
    $twilio = new Client($sid, $token);

    $codes = ["chocolate", "vanilla", "strawberry", "mint-chocolate-chip", "cookies-n-cream"];

    $message = $twilio->messages
        ->create("whatsapp:".env("MY_WHATSAPP_NUMBER"),
            [
                "body" => "Your ice-cream code is ".$codes[rand(0,4)],
                "from" => "whatsapp:".env("TWILIO_WHATSAPP_NUMBER")
            ]
        );

    print($message->sid);
});
