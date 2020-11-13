<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dev Routes
|--------------------------------------------------------------------------
|
| These are routes purely for testing and are active only in development
| environment, as this file is read and routes mapped on local env.
|
| Make sure to only use Closures and don't call any controller functions.
|
*/

Route::get('redis', function () {
    \Illuminate\Support\Facades\Redis::set('name', 'Caddy');

    $values = \Illuminate\Support\Facades\Redis::get('name');

    return $values;
});

Route::get('part', function () {
    $part = App\Part::find(1);

    $vehicle = $part->vehicle->only('year', 'brand', 'model', 'fuel');

    $part = $part->only('title');

    $searchable = array_merge($part, $vehicle);

    return $searchable;
});

Route::view('search', 'search.results');

Route::get('mailable', function () {
    $array = [
        'name'    => 'Mr. Barry Roob Sr.',
        'email'   => 'kkris@gmail.com',
        'subject' => "However, I've got.",
        'message' => 'Mouse, in a minute, trying to put everything.',
    ];

    return new App\Mail\ContactMail($array);
});

Route::get('denied', fn () => abort(403));
