<?php

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
	Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
	
	//admin password reset routes
    Route::post('/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

	Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register')->middleware('hasInvitation');
	Route::post('/register', 'Admin\RegisterController@register')->name('admin.register.post');

    Route::group(['middleware' => ['auth:admin']], function () {

	    Route::get('/', function () {
	        return view('admin.dashboard.index');
	    })->name('admin.dashboard');

		Route::get('/invite_list', 'Admin\InvitationController@index')->name('admin.invite');
	    Route::get('/invitation', 'Admin\InvitationController@create')->name('admin.invite.create');
		Route::post('/invitation', 'Admin\InvitationController@store')->name('admin.invitation.store');
		Route::get('/adminuser', 'Admin\AdminUserController@index')->name('admin.adminuser');
		Route::post('/adminuser', 'Admin\AdminUserController@updateAdminUser')->name('admin.adminuser.update');
	    Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
		Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');
		
		Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
		Route::post('/profile', 'Admin\ProfileController@update')->name('admin.profile.update');
		Route::post('/changepassword', 'Admin\ProfileController@changePassword')->name('admin.profile.changepassword');
		
		Route::group(['prefix'  =>   'banner'], function() {
			Route::get('/', 'Admin\BannerController@index')->name('admin.banner.index');
			Route::get('/create', 'Admin\BannerController@create')->name('admin.banner.create');
			Route::post('/store', 'Admin\BannerController@store')->name('admin.banner.store');
			Route::get('/{id}/edit', 'Admin\BannerController@edit')->name('admin.banner.edit');
			Route::post('/update', 'Admin\BannerController@update')->name('admin.banner.update');
			Route::get('/{id}/delete', 'Admin\BannerController@delete')->name('admin.banner.delete');
			Route::post('updateStatus', 'Admin\BannerController@updateStatus')->name('admin.banner.updateStatus');
		});
		
		Route::group(['prefix'  =>   'faq'], function() {
			Route::get('/', 'Admin\FaqController@index')->name('admin.faq.index');
			Route::get('/create', 'Admin\FaqController@create')->name('admin.faq.create');
			Route::post('/store', 'Admin\FaqController@store')->name('admin.faq.store');
			Route::get('/{id}/edit', 'Admin\FaqController@edit')->name('admin.faq.edit');
			Route::post('/update', 'Admin\FaqController@update')->name('admin.faq.update');
			Route::get('/{id}/delete', 'Admin\FaqController@delete')->name('admin.faq.delete');
			Route::post('updateStatus', 'Admin\FaqController@updateStatus')->name('admin.faq.updateStatus');
		});

		Route::group(['prefix'  =>   'news'], function() {
			Route::get('/', 'Admin\NewsController@index')->name('admin.news.index');
			Route::get('/create', 'Admin\NewsController@create')->name('admin.news.create');
			Route::post('/store', 'Admin\NewsController@store')->name('admin.news.store');
			Route::get('/{id}/edit', 'Admin\NewsController@edit')->name('admin.news.edit');
			Route::post('/update', 'Admin\NewsController@update')->name('admin.news.update');
			Route::get('/{id}/delete', 'Admin\NewsController@delete')->name('admin.news.delete');
			Route::post('updateStatus', 'Admin\NewsController@updateStatus')->name('admin.news.updateStatus');
		});

		Route::group(['prefix'  =>   'industry'], function() {
			Route::get('/', 'Admin\IndustryController@index')->name('admin.industry.index');
			Route::get('/create', 'Admin\IndustryController@create')->name('admin.industry.create');
			Route::post('/store', 'Admin\IndustryController@store')->name('admin.industry.store');
			Route::get('/{id}/edit', 'Admin\IndustryController@edit')->name('admin.industry.edit');
			Route::post('/update', 'Admin\IndustryController@update')->name('admin.industry.update');
			Route::get('/{id}/delete', 'Admin\IndustryController@delete')->name('admin.industry.delete');
			Route::post('updateStatus', 'Admin\IndustryController@updateStatus')->name('admin.industry.updateStatus');
		});

		Route::group(['prefix'  =>   'seniority'], function() {
			Route::get('/', 'Admin\SeniorityController@index')->name('admin.seniority.index');
			Route::get('/create', 'Admin\SeniorityController@create')->name('admin.seniority.create');
			Route::post('/store', 'Admin\SeniorityController@store')->name('admin.seniority.store');
			Route::get('/{id}/edit', 'Admin\SeniorityController@edit')->name('admin.seniority.edit');
			Route::post('/update', 'Admin\SeniorityController@update')->name('admin.seniority.update');
			Route::get('/{id}/delete', 'Admin\SeniorityController@delete')->name('admin.seniority.delete');
			Route::post('updateStatus', 'Admin\SeniorityController@updateStatus')->name('admin.seniority.updateStatus');
		});

		Route::group(['prefix'  =>   'user'], function() {
			Route::get('/', 'Admin\UserController@index')->name('admin.user.index');
			Route::get('/{id}/delete', 'Admin\UserController@delete')->name('admin.user.delete');
			Route::post('updateStatus', 'Admin\UserController@updateStatus')->name('admin.user.updateStatus');
		});

		Route::group(['prefix'  =>   'mentor'], function() {
			Route::get('/', 'Admin\MentorController@index')->name('admin.mentor.index');
			Route::get('/{id}/delete', 'Admin\MentorController@delete')->name('admin.mentor.delete');
			Route::post('updateStatus', 'Admin\MentorController@updateStatus')->name('admin.mentor.updateStatus');
		});
	
	});

});
?>