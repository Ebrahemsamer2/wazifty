<?php

// Admin Routes 


// User Routes


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Admin Dashboard Controllers

Route::group(['middleware' => ['auth', 'admin'] ], function () {

	Route::get('/admin/dashboard', 'admin\HomeController@index')->name('dashboard');

	Route::geT('/admin', function() {
		return redirect('/admin/dashboard');
	});

	Route::resource('admin/users', 'admin\UserController', ['except' => ['show']]);
	
	Route::get('admin/profile', ['as' => 'profile.edit', 'uses' => 'admin\ProfileController@edit']);

	Route::put('admin/profile', ['as' => 'profile.update', 'uses' => 'admin\ProfileController@update']);
	
	Route::put('admin/profile/password', ['as' => 'profile.password', 'uses' => 'admin\ProfileController@password']);

	Route::post('/admin/profile', ['as' => 'profile.updatePicture', 'uses' => 'admin\ProfileController@updatePicture']);

	Route::get('admin/profile/jobs', 'admin\ProfileController@jobs');
	
	Route::resource('admin/admins', 'admin\AdminController');

	Route::resource('admin/jobs', 'admin\JobController');

});

