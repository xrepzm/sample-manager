<?php

use SampleManager\Models\Request;
use SampleManager\Models\Sample;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/request-samples/{id}', function ($id) {
    $request = Request::with('author', 'samples')
        ->where('id', $id)->get();

    return response()->json(compact('request'));
});

Route::get('/sample-requests/{id}', function ($id) {
    $sample = Sample::with('requests')->where('id', $id)->get();

    return response()->json(compact('sample'));
});
