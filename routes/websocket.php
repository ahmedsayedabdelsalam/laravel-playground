<?php


use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, Request $request) {
    if (empty($request->user())) {
        return;
    }
    Websocket::loginUsing($request->user());
    $id = Websocket::getUserId();
    $name = request()->user()->name;
    Websocket::emit('message', "welcome $name, you are connected ($id)");
    // called while socket on connect
});

Websocket::on('sendMessage', function ($websocket, $data) {
    var_dump($data);
    var_dump(\App\User::find($data['to']));
    Websocket::toUserId($data['to'])->emit('message', $data['message']);
});

Websocket::on('disconnect', function ($websocket) {
    // called while socket on disconnect
});

Websocket::on('example', function ($websocket, $data) {
    $websocket->emit('message', $data);
});


