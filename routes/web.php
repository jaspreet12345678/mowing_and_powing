<?php

use App\Http\Controllers\Client\RecurringJobsController;
use App\Http\Controllers\Client\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\AuthenticationController;
use App\Http\Controllers\Client\FAQsController;
use App\Http\Controllers\Client\FavoriteProvidersController;
use App\Http\Controllers\Client\GoogleController;
use App\Http\Controllers\Client\GuestController;
use App\Http\Controllers\Client\JobHistoryController;
use App\Http\Controllers\Client\LawnMowingController;
use App\Http\Controllers\Client\NotificationController;
use App\Http\Controllers\Client\PaymentsController;
use App\Http\Controllers\Client\PrivacyPolicyController;
use App\Http\Controllers\Client\PropertiesController;
use App\Http\Controllers\Client\ReferAFriendController;
use App\Http\Controllers\Client\SnowPlowingController;
use App\Http\Controllers\Client\SupportController;
use App\Http\Controllers\Client\TermAndConditionController;
use Illuminate\Support\Facades\Artisan;

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

require_once __DIR__.'/admin.php';

// Optimize clear
Route::get('/optimize/clear',function(){
    Artisan::call('optimize:clear');
    return redirect('/');
});

// Laravel logs
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('test-notification', function(){
    sendNotification(1,3,'Testing','Testing');
    return 'Notification sent';
})->name('test');

Route::get('test', function(){
    return 'test';
})->name('test');

Route::get('/', [AuthenticationController::class, 'homePage'])->name('/');

// OAuth Google login
Route::group(['controller' => GoogleController::class],function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
    Route::get('auth/google/verify-phone-number', 'verifyPhoneNumberIndex')->name('auth.google.verify-phone-number.index');
    Route::post('auth/google/verify-phone-number', 'verifyPhoneNumber')->name('auth.google.verify-phone-number');
    Route::post('auth/google/complete-registration', 'registerUsingGoogleOauth')->name('auth.google.complete-registration');
});

// Authentications
Route::get('login', [AuthenticationController::class, 'loginIndex'])->name('web.login');
Route::post('login', [AuthenticationController::class, 'login']);
Route::get('signup', [AuthenticationController::class, 'signupIndex'])->name('signup');
Route::post('signup', [AuthenticationController::class, 'signup']);
Route::get('verify-email', [AuthenticationController::class, 'verifyEmailIndex'])->name('verify-email');
Route::post('verify-email', [AuthenticationController::class, 'verifyEmail']);
Route::get('verify-phone-number', [AuthenticationController::class, 'verifyPhoneNumberIndex'])->name('verify-phone-number');
Route::post('verify-phone-number', [AuthenticationController::class, 'verifyPhoneNumber']);
Route::get('registration', [AuthenticationController::class, 'registrationIndex'])->name('registration');
Route::post('registration', [AuthenticationController::class, 'registration']);
Route::post('resend-code', [AuthenticationController::class, 'resendCode'])->name('resend-code');
Route::get('auth/check', [AuthenticationController::class, 'authCheck'])->name('auth-check');
Route::get('/delete-account', [AuthenticationController::class, 'deleteAccount'])->name('delete-account');

// Forget password
Route::group(['prefix' => 'forget-password','as' => 'forget-password.'], function () {
    Route::get('email', [AuthenticationController::class, 'resetPasswordEmail'])->name('email');
    Route::get('verify-email', [AuthenticationController::class, 'verifyResetPasswordEmailIndex'])->name('verify-email.index');
    Route::post('verify-email', [AuthenticationController::class, 'verifyResetPasswordEmail'])->name('verify-email');
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordIndex'])->name('reset-password.index');
    Route::post('reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');
});

//Logout
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

// Terms & Conditions
Route::get('/terms-and-conditions', [TermAndConditionController::class, 'termsAndConditions'])->name('terms-and-conditions');

// Privacy Policy
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'privacyPolicy'])->name('privacy-policy');

// Order by guest
Route::get('select-service',[GuestController::class,'selectService'])->name('select-service');

 // Order Services => Lawn Mowing Service
 Route::group(['prefix' => 'lawn-mowing','as' => 'lawn-mowing.'], function () {

    Route::get('/',function(){return redirect(route('lawn-mowing.start'));});
    Route::post('/get-cleanups',[LawnMowingController::class,'getCleanUps'])->name('get-cleanups');
    Route::post('/get-estimations',[LawnMowingController::class,'getEstimations'])->name('get-estimations');
    Route::post('/get-order-summary',[LawnMowingController::class,'orderSummary'])->name('get-order-summary');
    Route::post('/update-tip',[LawnMowingController::class,'updateTip'])->name('update-tip');
    Route::post('/apply-coupon-discount',[LawnMowingController::class,'applyCouponDiscount'])->name('apply-coupon');
    Route::post('/remove-coupon-discount',[LawnMowingController::class,'removeCouponDiscount'])->name('remove-coupon');
    Route::post('/pay',[LawnMowingController::class,'pay'])->name('pay');

    // Start
    Route::get('/start',[LawnMowingController::class,'startIndex'])->name('start');
    Route::post('/start',[LawnMowingController::class,'start'])->name('start-order');

    // Steps
    Route::get('/{property_id}',[LawnMowingController::class,'steps'])->name('steps');

});

// Order Services => Snow Plowing Service
Route::group(['prefix' => 'snow-plowing','as' => 'snow-plowing.'], function () {

    // Route::get('/',function(){return redirect(route('snow-plowing.start'));});
    Route::post('/get-order-summary',[SnowPlowingController::class,'orderSummary'])->name('get-order-summary');
    Route::post('/update-tip',[SnowPlowingController::class,'updateTip'])->name('update-tip');
    Route::post('/apply-coupon-discount',[SnowPlowingController::class,'applyCouponDiscount'])->name('apply-coupon');
    Route::post('/remove-coupon-discount',[SnowPlowingController::class,'removeCouponDiscount'])->name('remove-coupon');
    Route::post('/pay',[SnowPlowingController::class,'pay'])->name('pay');

    // Start
    Route::get('/start',[SnowPlowingController::class,'startIndex'])->name('start');

    // Address
    Route::get('/{type}',[SnowPlowingController::class,'addressIndex'])->name('address');
    Route::post('/{type}',[SnowPlowingController::class,'address'])->name('address.post');

    // Steps
    Route::get('/{type}/{property_id}',[SnowPlowingController::class,'steps'])->name('steps');
    Route::post('/{type}/{property_id}',[SnowPlowingController::class,'order']);

});

Route::group(['middleware'=>['auth:web','authenticate:web']], function () {

    // Dashboard
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

    // Edit Profile
    Route::get('edit-profile',[AuthenticationController::class,'editProfile'])->name('editProfile');
    Route::post('edit-profile',[AuthenticationController::class,'updateProfile'])->name('edit-profile');

    // Recurring Jobs
    Route::group(['prefix' => 'recurring-jobs', 'as' => 'recurring-jobs.'], function () {
        Route::get('/',[RecurringJobsController::class,'index'])->name('index');
        Route::get('/{id}',[RecurringJobsController::class,'show'])->name('show');
        Route::get('/cancel-warning/{id}',[RecurringJobsController::class,'cancelWarning'])->name('cancel-warning');
        Route::get('/cancel/{id}',[RecurringJobsController::class,'cancel'])->name('cancel');
    });

    // Properties
    Route::group(['prefix' => 'properties', 'as' => 'properties.'], function () {

        Route::get('{type}',[PropertiesController::class,'index'])->name('index');
        Route::get('{type}/add',[PropertiesController::class,'addPropertyIndex'])->name('add');
        Route::post('{type}/add',[PropertiesController::class,'addProperty']);
        Route::delete('delete/{id}',[PropertiesController::class,'deleteProperty'])->name('delete');
    });

    // Payments
    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {

        // Wallet System
        Route::get('wallet-system',[PaymentsController::class,'walletSystem'])->name('wallet-system');
        Route::get('wallet-system/how-it-works',[PaymentsController::class,'howItWorks'])->name('wallet-system.how-it-works');
        Route::post('wallet-system/update-wallet-setting',[PaymentsController::class,'updateWalletSetting'])->name('wallet-system.update-wallet-setting');
        Route::get('wallet-system/checkout',[PaymentsController::class,'checkout'])->name('wallet-system.checkout');
        Route::post('wallet-system/purchase',[PaymentsController::class,'purchase'])->name('wallet-system.purchase');

        // Cards
        Route::get('cards',[PaymentsController::class,'cards'])->name('cards');
        Route::delete('cards/{id}',[PaymentsController::class,'deleteCard'])->name('cards.delete');
        Route::get('cards/default/{id}',[PaymentsController::class,'makeDefaultCard'])->name('cards.default');
        Route::get('add-card',[PaymentsController::class,'addCardIndex'])->name('add-card-index');
        Route::get('add-card-form',[PaymentsController::class,'addCardForm'])->name('add-card-form');
        Route::post('add-card',[PaymentsController::class,'addCard'])->name('add-card');
    });

    // Job Histories
    Route::group(['prefix' => 'job-history', 'as' => 'job-history.'], function () {

        // Prodiver's Chat
        Route::group(['prefix' => 'providers-chat','as' => 'providers-chat.'], function () {
            Route::get('/{order_id}',[JobHistoryController::class,'providersChat'])->name('index');
            Route::post('/send-message',[JobHistoryController::class,'sendMessage'])->name('send-message');
        });

        // Rate the job
        Route::get('/rate-the-job/{id}',[JobHistoryController::class,'rateTheJob'])->name('rate-the-job');
        Route::post('/rate-the-job/{id}',[JobHistoryController::class,'saveTheJobRatings']);

        // Mark job as completed
        Route::get('/mark-job-as-completed/{id}',[JobHistoryController::class,'markJobAsCompleted'])->name('mark-job-as-completed');

        // Jobs
        Route::get('/{pageTitle}',[JobHistoryController::class,'jobs'])->name('jobs');
        Route::get('/jobs/details/{id}',[JobHistoryController::class,'jobsDetails'])->name('jobs.details');
        Route::post('/jobs/details/{id}/update',[JobHistoryController::class,'jobsDetailsUpdate'])->name('jobs.details.update');
        Route::get('/jobs/cancel-warning/{id}',[JobHistoryController::class,'cancelJobWarning'])->name('jobs.cancel-warning');
        Route::get('/jobs/cancel/{id}',[JobHistoryController::class,'cancelJob'])->name('jobs.cancel');

        // Upcoming Jobs Proposals
        Route::group(['prefix' => 'upcoming-jobs','as' => 'upcoming-jobs.'], function () {
            Route::get('proposals/{id}',[JobHistoryController::class,'upcomingJobsProposals'])->name('proposals');
            Route::get('proposal/accept/{id}',[JobHistoryController::class,'acceptProposal'])->name('proposal.accept');
            Route::get('proposal/cancel/{id}',[JobHistoryController::class,'cancelProposal'])->name('proposal.cancel');
            Route::get('/toggle-favorite-provider/{id}',[JobHistoryController::class,'toggleFavoriteProvider'])->name('toggle-favorite-provider');
        });

        // Ongoing Jobs Details
        Route::get('/ongoing-jobs/details/{id}',[JobHistoryController::class,'ongoingJobsDetails'])->name('ongoing-jobs.details');

    });

    // Support
    Route::group(['prefix' => 'support', 'as' => 'support.'], function () {

        Route::get('/',[SupportController::class,'index'])->name('index');
        Route::post('/',[SupportController::class,'createSupportTicket']);
    });

    // About Us
    Route::group(['prefix' => 'about-us', 'as' => 'about-us.'], function () {

        Route::get('/',[AboutUsController::class,'index'])->name('index');
    });

    // FAQs
    Route::group(['prefix' => 'faqs', 'as' => 'faqs.'], function () {

        Route::get('/',[FAQsController::class,'index'])->name('index');
    });

    // Favorite Providers
    Route::group(['prefix' => 'favorite-providers', 'as' => 'favorite-providers.'], function () {

        Route::get('/',[FavoriteProvidersController::class,'index'])->name('index');
        Route::get('/details/{id}',[FavoriteProvidersController::class,'providerDetails'])->name('details');
    });

    // Refer a Friend
    Route::group(['prefix' => 'refer-a-friend', 'as' => 'refer-a-friend.'], function () {

        Route::get('/',[ReferAFriendController::class,'index'])->name('index');
        Route::get('/share',[ReferAFriendController::class,'share'])->name('share');
    });

    // Notifications
    Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {

        Route::get('/',[NotificationController::class,'index'])->name('index');
        Route::get('/update-status',[NotificationController::class,'updateStatus'])->name('update-status');
    });

    // // Order Services => Lawn Mowing Service
    // Route::group(['prefix' => 'lawn-mowing','as' => 'lawn-mowing.'], function () {

    //     Route::get('/',function(){return redirect(route('lawn-mowing.start'));});
    //     Route::post('/get-cleanups',[LawnMowingController::class,'getCleanUps'])->name('get-cleanups');
    //     Route::post('/get-estimations',[LawnMowingController::class,'getEstimations'])->name('get-estimations');
    //     Route::post('/get-order-summary',[LawnMowingController::class,'orderSummary'])->name('get-order-summary');
    //     Route::post('/update-tip',[LawnMowingController::class,'updateTip'])->name('update-tip');
    //     Route::post('/apply-coupon-discount',[LawnMowingController::class,'applyCouponDiscount'])->name('apply-coupon');
    //     Route::post('/remove-coupon-discount',[LawnMowingController::class,'removeCouponDiscount'])->name('remove-coupon');
    //     Route::post('/pay',[LawnMowingController::class,'pay'])->name('pay');

    //     // Start
    //     Route::get('/start',[LawnMowingController::class,'startIndex'])->name('start');
    //     Route::post('/start',[LawnMowingController::class,'start'])->name('start-order');

    //     // Steps
    //     Route::get('/{property_id}',[LawnMowingController::class,'steps'])->name('steps');

    // });

    // // Order Services => Snow Plowing Service
    // Route::group(['prefix' => 'snow-plowing','as' => 'snow-plowing.'], function () {

    //     // Route::get('/',function(){return redirect(route('snow-plowing.start'));});
    //     Route::post('/get-order-summary',[SnowPlowingController::class,'orderSummary'])->name('get-order-summary');
    //     Route::post('/update-tip',[SnowPlowingController::class,'updateTip'])->name('update-tip');
    //     Route::post('/apply-coupon-discount',[SnowPlowingController::class,'applyCouponDiscount'])->name('apply-coupon');
    //     Route::post('/remove-coupon-discount',[SnowPlowingController::class,'removeCouponDiscount'])->name('remove-coupon');
    //     Route::post('/pay',[SnowPlowingController::class,'pay'])->name('pay');

    //     // Start
    //     Route::get('/start',[SnowPlowingController::class,'startIndex'])->name('start');

    //     // Address
    //     Route::get('/{type}',[SnowPlowingController::class,'addressIndex'])->name('address');
    //     Route::post('/{type}',[SnowPlowingController::class,'address'])->name('address.post');

    //     // Steps
    //     Route::get('/{type}/{property_id}',[SnowPlowingController::class,'steps'])->name('steps');
    //     Route::post('/{type}/{property_id}',[SnowPlowingController::class,'order']);

    // });
});

// For theme designs => Must be at the end of the file
Route::get('/{theme}', function($theme){
    if($theme == 'theme'){
        $theme = "index.html";
    }
    $name = explode(".",$theme)[0];
    return view('theme.'.$name);
});
