<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
Route::get('command', function () {
	/* php artisan migrate */
    \Artisan::call('migrate:fresh --seed');
    dd("Done");
});

Route::group(['middleware' => ['auth','verified', 'userStatus']], function () {
	Route::get('profile', 'Site\ProfileController@index')->name('user.profile');
    Route::post('profile', 'Site\ProfileController@profileUpdate')->name('user.updateprofile');
    Route::get('checkout', 'Site\PackageController@index')->name('checkout');;
    //Route::get('upgrade/{id}', 'Site\PackageController@upgrade');
    Route::post('upgrade', 'Site\PackageController@upgrade')->name('adsUpgrade');
    Route::post('package', 'Site\PackageController@packageUpdate')->name('user.updatepackage');
    Route::get('logout', 'Site\ProfileController@logout')->name('user.logout');
    Route::get('my-ads/{type}','Site\ProfileController@fetchUserAds')->name('user.myads');

    Route::get('post-ads','Site\AdsController@craeteAds')->name('user.post.ad');
    Route::post('getCategoryFields', 'Site\AdsController@getCategoryFields')->name('user.customform.getCategoryFields');
    Route::post('ad-submit','Site\AdsController@storeAds')->name('adsubmit');
    
    Route::post('getCategoryFieldValues', 'Site\AdsController@getCategoryFieldValues')->name('ads.customform.getValues');
    Route::post('getRateValues', 'Site\AdsController@getRateValues')->name('ads.customform.getRateValues');
    Route::get('edit-ads/{id}','Site\AdsController@editAds');
    Route::post('updateads','Site\AdsController@updateAds')->name('updateads');
    Route::post('storeadmessage','Site\AdsController@storeAdMessage')->name('storeadmessage');
    Route::post('storereportabuse','Site\AdsController@storeReportAbuse')->name('storereportabuse');
    Route::get('update-free-package/{ad_id}/{id}','Site\PaymentController@updateFreePackage');
});
    
    // Route::get('/',function(){
    //     return redirect('/login');
    // });

	//user password reset routes
    Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
    Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
    Route::post('password/reset','Auth\ResetPasswordController@reset');
    Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

/* Route::get('/', function()
    {
        return view('welcome');
    }); */
Route::post ( '/stripe', 'Site\PaymentController@paymentProcess' )->name('paypost');
Route::post ( '/upgradepayment', 'Site\PaymentController@upgradeProcess' )->name('upgradepayment');

Auth::routes(['verify' => true,'login'=>false]);

require 'admin.php';
//Route::view('/admin', 'admin.dashboard.index');

/*=======================web-site============================*/

// Route::get('/','Site\HomeController@index');
// Route::get('ad-list','Site\AdsController@index');
// Route::get('genre/{slug}','Site\ShowController@showsByGenre');
// Route::get('list/{slug}','Site\ShowController@showsByCategory');
// Route::get('details/{slug}','Site\ShowController@showDetails');

// Route::get('ask-for-otp','Site\AuthController@askForOtp');
// Route::post('mobile-no-submit','Site\AuthController@mobileNoSubmit');
// Route::get('enter-otp/{id}','Site\AuthController@enterOtp');
// Route::post('submit-otp','Site\AuthController@submitOtp');
// Route::get('logout', 'Site\AuthController@logout');
// Route::get('update-basic-data/{id}','Site\AuthController@updateBasicData');
// Route::post('submit-basic-data','Site\AuthController@submitBasicData');
// Route::get('subscribe','Site\PackageController@index');

// Route::post('/pay-per-click-submit', 'Site\ShowController@payPerClickSubmit')->name('site.show.payPerClickSubmit');
// Route::post('/store-package-information', 'Site\PackageController@storePackageInformation')->name('site.package.storepackageinfo');


// New Routes
Route::get('/','Site\WebsiteController@index');
Route::get('/mentor/login','Site\WebsiteController@showLoginFormForMentor');
Route::post('/mentor/mentee/login','Site\WebsiteController@postLogin');

Route::get('registration/mentee','Site\WebsiteController@signupFormMentee')->name('singup.mentee');
Route::get('registration/mentor','Site\WebsiteController@signupFormMentor')->name('singup.mentor');
Route::post('registration/mentor_mentee','Site\WebsiteController@signUpMentorAndMentee')->name('registration.mentee_mentor');
Route::get('find/mentors','Site\WebsiteController@findMentors')->name('mentors.find');
Route::get('about-us','Site\WebsiteController@aboutUs')->name('aboutus');
Route::get('contact-us','Site\WebsiteController@contactUs')->name('contactus');
Route::get('logout','Site\WebsiteController@logout');
