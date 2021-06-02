<?php
use Illuminate\Http\Request;


Route::prefix('messages')->group(function () {
    Route::get('/', 'Site\MessageController@index')->name('messages');
    Route::post('/idInfo', 'Site\MessagesController@idFetchData');
    Route::post('/sendMessage', 'Site\MessagesController@send')->name('send.message');
    Route::post('/fetchMessages', 'Site\MessagesController@fetch')->name('fetch.messages');
    // Route::get('/download/{fileName}', 'MessagesController@download')->name(config('chatify.attachments.download_route_name'));
    Route::post('/chat/auth', 'Site\MessagesController@pusherAuth')->name('pusher.auth');
    Route::post('/makeSeen', 'Site\MessagesController@seen')->name('messages.seen');
    Route::post('/getContacts', 'Site\MessagesController@getContacts')->name('contacts.get');
    Route::post('/updateContacts', 'Site\MessagesController@updateContactItem')->name('contacts.update');
    Route::post('/star', 'Site\MessagesController@favorite')->name('star');
    Route::post('/favorites', 'Site\MessagesController@getFavorites')->name('favorites');
    Route::post('/search', 'Site\MessagesController@search')->name('search');
    Route::post('/shared', 'Site\MessagesController@sharedPhotos')->name('shared');
    Route::post('/deleteConversation', 'Site\MessagesController@deleteConversation')->name('conversation.delete');
    Route::post('/updateSettings', 'Site\MessagesController@updateSettings')->name('avatar.update');
    Route::post('/setActiveStatus', 'Site\MessagesController@setActiveStatus')->name('activeStatus.set');
    Route::get('/{id}', 'Site\MessagesController@index')->name('user');
});



Route::get('command', function () {
	/* php artisan migrate */
    \Artisan::call('migrate:fresh --seed');
    return "Done";
});

//user password reset routes
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('password/reset','Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

Auth::routes(['verify' => true,'login'=>false]);

require 'admin.php';

// New Routes
Route::get('/','Site\WebsiteController@index');
// Registration
Route::get('registration/mentee','Site\WebsiteController@signupFormMentee')->name('singup.mentee');
Route::get('registration/mentor','Site\WebsiteController@signupFormMentor')->name('singup.mentor');
Route::post('registration/mentor_mentee','Site\WebsiteController@signUpMentorAndMentee')->name('registration.mentee_mentor');
// Login
Route::get('/mentor/login','Site\WebsiteController@showLoginFormForMentor');
Route::get('/mentee/login','Site\WebsiteController@showLoginFormForMentee');
Route::post('/mentor/mentee/login','Site\WebsiteController@postLogin');
// Forget Password
Route::get('forget/password/{userType}','Site\WebsiteController@showForgetPassword')->name('both.forget.password');
Route::post('forget/password/{userType}','Site\WebsiteController@postForgetPassword')->name('both.forget.password.post');

// mentors Route
Route::get('mentor/mentee/setting','Site\MentorController@setting')->name('mentor.mentee.setting');
Route::post('mentor/mentee/setting','Site\MentorController@settingAccountUpdate')->name('mentor.mentee.account_update');
Route::get('mentor/mentee/email/setting','Site\MentorController@settingEmail')->name('mentor.email.setting');
Route::post('mentor/mentee/email/setting','Site\MentorController@settingEmailUpdate')->name('mentor.email.update');
Route::get('mentor/mentee/password/setting','Site\MentorController@settingPassword')->name('mentor.password.setting');
Route::post('mentor/mentee/password/setting/{userType}','Site\MentorController@settingPasswordUpdate')->name('mentor.password.update');

Route::post('message/submit/to_mentor','Site\MentorController@messageSubmitToMentor')->name('message.submit.to.mentor');
Route::get('mentor/shift/availability','Site\MentorController@mentorAvailabilitySettingView')->name('mentor.availability.setting');
Route::post('mentor/shift/availability','Site\MentorController@saveMentorAvailabilitySetting')->name('mentor.availability.setting.save');

Route::get('mentor/mentee/message/log','Site\MentorController@messageLog')->name('user.message.log');
Route::get('booking/history','Site\MenteeController@purchasHistory')->name('booking.history');
Route::get('mentor/booking/request','Site\MentorController@seeBookingDetails')->name('mentor.booking.request');

Route::get('find/mentors','Site\WebsiteController@findMentors')->name('mentors.find');
Route::get('mentor/details/{mentorId}','Site\WebsiteController@mentorDetails')->name('mentor.details');
// Route::get('mentor/full/availability/{mentorId}','Site\MentorController@viewFullAvailability')->name('mentor.full.availability');
Route::post('mentor/booking/request','Site\MentorController@holdBookingRequest')->name('mentor.booking.slot');
Route::get('about-us','Site\WebsiteController@aboutUs')->name('aboutus');
Route::get('contact-us','Site\WebsiteController@contactUs')->name('contactus');
Route::get('logout','Site\WebsiteController@logout');

Route::get('user/zoom/meeting','ZoomMeetingController@list')->name('user.zoom.meeting');
Route::get('user/zoom/meeting/{meetingId}/cancel','ZoomMeetingController@cancelMeeting')->name('user.zoom.meeting.cancel');

// STRIPE Payment Routes
Route::get('slot/booking/stripe', 'StripePaymentController@bookingSlotstripe')->name('slot.booking.stripe');
Route::post('slot/booking/stripe', 'StripePaymentController@bookingStripePost')->name('slot.booking.stripe.post');
Route::get('stripe/payment/success', 'Site\MentorController@stripeBookingConfirmed')->name('stripe.payment.success');
Route::get('payment/bokking/success','StripePaymentController@thankyouPageToSHow')->name('mentor.booked.success');

Route::get('terms-and-condition','Site\WebsiteController@termsAndCondition')->name('terms.condition');
Route::get('policy','Site\WebsiteController@policy')->name('policy');



// Cron Routes
Route::get('create_teacher_slot','CronController@teacherSlot');


// Route::get('stripe/{Id}/success','StripePaymentController@successTransaction')->name('stripe.success');

// Auth::routes();
// Route::group(['middleware' => ['auth','verified', 'userStatus']], function () {
//  Route::get('profile', 'Site\ProfileController@index')->name('user.profile');
//     Route::post('profile', 'Site\ProfileController@profileUpdate')->name('user.updateprofile');
//     Route::get('checkout', 'Site\PackageController@index')->name('checkout');;
//     //Route::get('upgrade/{id}', 'Site\PackageController@upgrade');
//     Route::post('upgrade', 'Site\PackageController@upgrade')->name('adsUpgrade');
//     Route::post('package', 'Site\PackageController@packageUpdate')->name('user.updatepackage');
//     Route::get('logout', 'Site\ProfileController@logout')->name('user.logout');
//     Route::get('my-ads/{type}','Site\ProfileController@fetchUserAds')->name('user.myads');

//     Route::get('post-ads','Site\AdsController@craeteAds')->name('user.post.ad');
//     Route::post('getCategoryFields', 'Site\AdsController@getCategoryFields')->name('user.customform.getCategoryFields');
//     Route::post('ad-submit','Site\AdsController@storeAds')->name('adsubmit');

//     Route::post('getCategoryFieldValues', 'Site\AdsController@getCategoryFieldValues')->name('ads.customform.getValues');
//     Route::post('getRateValues', 'Site\AdsController@getRateValues')->name('ads.customform.getRateValues');
//     Route::get('edit-ads/{id}','Site\AdsController@editAds');
//     Route::post('updateads','Site\AdsController@updateAds')->name('updateads');
//     Route::post('storeadmessage','Site\AdsController@storeAdMessage')->name('storeadmessage');
//     Route::post('storereportabuse','Site\AdsController@storeReportAbuse')->name('storereportabuse');
//     Route::get('update-free-package/{ad_id}/{id}','Site\PaymentController@updateFreePackage');
// });

    // Route::get('/',function(){
    //     return redirect('/login');
    // });
/* Route::get('/', function()
    {
        return view('welcome');
    }); */
// Route::post ( '/stripe', 'Site\PaymentController@paymentProcess' )->name('paypost');
// Route::post ( '/upgradepayment', 'Site\PaymentController@upgradeProcess' )->name('upgradepayment');

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
