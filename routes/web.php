<?php

// Resume Routes

Route::get('/resume/{resume}','admin\ResumeController@viewResume');


// Auth Routes

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function() {
	return redirect('/');
});

Route::post('/', 'HomeController@contactForm')->name('home');


// User Applications Routes

Route::get('/user/applications', 'UserApplicationsController@index');

Route::patch('/user/applications', 'UserApplicationsController@update_answers');

// User Saved jobs Routes

Route::get('/user/saved-jobs', 'UserSavedJobsController@index');

Route::post('/user/saved-jobs', 'UserSavedJobsController@save');

// Jobs 

Route::get('/jobs', 'JobController@index');

Route::post('/jobs', 'UserSavedJobsController@save')->middleware('auth');

Route::get('/jobs/{slug}', 'JobController@show');

Route::post('/jobs/{slug}', 'JobController@apply')->middleware('auth');

Route::get('/{place}-jobs','JobController@jobsByPlace');

Route::get('/{place}-jobs/{category}','JobController@jobsByCategoryAndPlace');


// user edit profile

Route::get('/user/profile', 'UserProfileController@index');

Route::patch('/user/profile', 'UserProfileController@update');

Route::post('/user/profile', 'UserProfileController@updatePicture');

// Visitation view for users and companies

Route::get('/user/{id}', 'UserProfileController@show');



// company edit profile

Route::get('/company/profile', 'CompanyProfileController@index');

Route::patch('/company/profile', 'CompanyProfileController@update');

Route::post('/company/profile', 'CompanyProfileController@updatePicture');

// Visitation view for users and companies

Route::get('/company/{id}', 'CompanyProfileController@show');



// Admin Dashboard Controllers For main website

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

	Route::resource('/admin/jobs', 'admin\JobController');

	Route::resource('/admin/applications', 'admin\ApplicationController');

	Route::get('/admin/resumes', 'admin\ResumeController@index');

	Route::get('/admin/resumes/{id}/download', 'admin\ResumeController@download');

	Route::delete('/admin/resumes/{id}', 'admin\ResumeController@destroy');

	Route::post('/admin/applications/{id}', 'admin\ApplicationController@addquestions')->name('admin.applications.create');



	// user messages controller 

	Route::get('/admin/usermessages', 'admin\UsersMessagesController@index');

	Route::patch('/admin/usermessages', 'admin\UsersMessagesController@active');
	
	Route::delete('/admin/usermessages', 'admin\UsersMessagesController@delete');


});

// Language Route

Route::get('/{lang}', function($lang) {
	if(is_dir("../resources/lang/".$lang)) {
		\Session::put('locale', $lang);
		return redirect()->back();
	}else {
		return abort(404);
	}
});


// Blog System Controllers 

//==================== Users ======================