<?php

Route::group(['middleware' => ['web']], function () {

	// Home
	Route::get('/', [
		'uses' => 'HomeController@index', 
		'as' => 'home'
	]);
	Route::get('language/{lang}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');

    Route::get ( '/redirect/{service}', 'SocialAuthController@redirect' );
    Route::get( '/callback/{service}', 'SocialAuthController@callback' );

    Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');

	// Admin
	Route::get('admin', [
		'uses' => 'AdminController@admin',
		'as' => 'admin',
		'middleware' => 'admin'
	]);

    Route::get('administrator', 'Auth\AuthController@getAdmin');
    Route::post('administrator', 'Auth\AuthController@postAdmin');
    Route::get('adminlogout', 'AdminController@getLogoutAdmin');

	// Blog
	Route::get('blog/order', ['uses' => 'BlogController@indexOrder', 'as' => 'blog.order']);
	Route::get('articles', 'BlogController@indexFront');
	Route::get('blog/tag', 'BlogController@tag');
	Route::get('blog/search', 'BlogController@search');

	Route::put('postseen/{id}', 'BlogController@updateSeen');
	Route::put('postactive/{id}', 'BlogController@updateActive');

	Route::resource('blog', 'BlogController');

	// Comment
	Route::resource('comment', 'CommentController', [
		'except' => ['create', 'show']
	]);

	Route::put('commentseen/{id}', 'CommentController@updateSeen');
	Route::put('uservalid/{id}', 'CommentController@valid');


	// Contact
	Route::resource('contact', 'ContactController', [
		'except' => ['show', 'edit']
	]);


	// User
	Route::get('user/sort/{role}', 'UserController@indexSort');

	Route::get('user/roles', 'UserController@getRoles');
	Route::post('user/roles', 'UserController@postRoles');

    Route::get('user/setSpecial', 'UserController@getSpecial');
    Route::post('user/setSpecial', 'UserController@setSpecial');
    Route::get('cancelSpecial', 'UserController@cancelSpecial');

	Route::put('userseen/{user}', 'UserController@updateSeen');

	Route::resource('user', 'UserController');

	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('auth/confirm/{token}', 'Auth\AuthController@getConfirm');

	// Resend routes...
	Route::get('auth/resend', 'Auth\AuthController@getResend');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');

	// setting router
    Route::post('/settings', 'HomeController@settingSet');
    Route::get('getsettings', 'HomeController@getsettings');
    Route::group(['prefix' => 'getsettings'], function() {
        Route::get('/',['as'       =>'getsettings','uses' => 'HomeController@getsettings']);
    });

    Route::resource('/compare-coinmarketcap', 'HomeController@coinmarketcap');
    Route::resource('/borrow-calc', 'HomeController@borrowcalc');
    Route::resource('/createALoan', 'BorrowController@createNew');
    Route::resource('/getAloan', 'HomeController@getNewLoan');
    Route::get('createInvest/{id}','InvestController@createNew');

    Route::get('manager', 'HomeController@manager');
    Route::resource('deleteitem', 'HomeController@deleteitem');
    Route::resource('checkout', 'HomeController@checkout');
    Route::resource('verified', 'HomeController@verified');
    Route::resource('uploadVerified', 'HomeController@uploadVerified');

    Route::resource('borrowWaiting', 'HomeController@borrowWaiting');
    Route::get('verifiedItem', 'HomeController@verifiedItem');

    Route::post('moneyReceived', 'HomeController@methodPayment');
    Route::post('saveAccount', 'HomeController@saveAccount');
    Route::get('confirmInvest', 'HomeController@confirmInvest');
    Route::post('confirmInvest', 'HomeController@postConfirmInvest');

    Route::get('confirmBorrow', 'HomeController@confirmBorrow');
    Route::post('confirmBorrow', 'HomeController@postConfirmBorrow');

    // Blog
    Route::get('IPAdmin/order', ['uses' => 'IPAdminController@indexOrder', 'as' => 'IPAdmin.order']);
    Route::get('IPAdmin/search', 'IPAdminController@search');
    Route::resource('IPAdmin', 'IPAdminController');

    Route::resource('/homeFilter', 'HomeController@homeFilter');

	// borrow
	Route::get('borrow/order', ['uses' => 'BorrowController@indexOrder', 'as' => 'borrow.order']);
	Route::get('borrow', 'BorrowController@indexFront');
	Route::get('borrow/search', 'BorrowController@search');

	Route::resource('borrow', 'BorrowController');

	// invest
	Route::get('invest/order', ['uses' => 'InvestController@indexOrder', 'as' => 'invest.order']);
	Route::get('invest', 'InvestController@indexFront');
	Route::get('invest/search', 'InvestController@search');

	Route::resource('invest', 'InvestController');

    Route::resource('/ttest', 'HomeController@ttest');

    Route::resource('/tcoupon', 'HomeController@tcoupon');

    // slideshow
    Route::get('slideshow/order', ['uses' => 'SlideshowController@indexOrder', 'as' => 'Slideshow.order']);
    Route::resource('slideshow', 'SlideshowController');

	// update borrow date
	Route::get('borrowUpdateDate/{id}', 'BorrowController@borrowUpdateDate');

	// test log
	Route::get('tlog', 'HomeController@cronSet');
	Route::get('treminder1', 'HomeController@getBorrowReminder');
    Route::get('treminderlost', 'HomeController@getBorrowReminderLost');

    Route::resource('filterBorrow', 'HomeController@filterBorrow');
    Route::get('confirmUser', 'HomeController@confirmUser');
    Route::post('confirmUser', 'HomeController@confirmUser');
});