<?php

use Illuminate\Support\Facades\Redis;
use App\Events\MessageSent;


Route::post('send-message' , function (\Illuminate\Http\Request $request) {

    event(new MessageSent($request->input('message')));

    return 'My My My Message : ' . $request->input('message');


});

Route::get('/', function () {

    return view('index');

});
