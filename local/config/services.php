<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],

    'facebook' => [
        'client_id' => '606771139713362',
        'client_secret' => 'b0b4b266b1bb1aa8a42db046002da34b',
        'redirect' => 'http://localhost/lending/callback/facebook',
    ],

    'google' => [
        'client_id' => '974603231392-q9akc2e6j6liuiv7j33np56ls31t6phh.apps.googleusercontent.com',
        'client_secret' => 'oH0dL8ZvoPOXZsqJV0_TvUzK',
        'redirect' => 'http://localhost/lending/callback/google',
    ],
];
