<?php

declare(strict_types=1);

return [

	/*
	|--------------------------------------------------------------------------
	| Site owner name
	|--------------------------------------------------------------------------
	|
	| This config is used on the contact mail template for now.
	|
	*/

	'owner' => env('OWNER_NAME', 'Salim'),
	'admin' => [
		'name'  => env('ADMIN_NAME', 'Admin'),
		'email' => env('ADMIN_EMAIL', 'admin@turbo.com'),
	],
];
