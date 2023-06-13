<?php

use App\Http\Controllers\Api\Customer\AuthenticationController as CustomerAuthenticationController;
use App\Http\Controllers\Api\Customer\FAQsController;
use App\Http\Controllers\Api\Customer\ForgetPasswordController;
use App\Http\Controllers\Api\Customer\PaymentsController;
use App\Http\Controllers\Api\Customer\PropertiesController;
use App\Http\Controllers\Api\Customer\LawnMowingController;
use App\Http\Controllers\Api\Customer\SnowPlowingController;
use App\Http\Controllers\Api\Customer\JobHistoryController;
use App\Http\Controllers\Api\Customer\SupportController;
use App\Http\Controllers\Api\Customer\FavoriteProvidersController;
use App\Http\Controllers\Api\Customer\PrivacyPolicyController;
use App\Http\Controllers\Api\Customer\RatingsController;
use App\Http\Controllers\Api\Customer\TermAndConditionController;
use App\Http\Controllers\Api\Provider\AboutUsController;
use App\Http\Controllers\Api\Provider\RatingsController as ProviderRatingController;
use App\Http\Controllers\Api\Provider\AuthenticationController as ProviderAuthenticationController;
use App\Http\Controllers\Api\Provider\CustomerByProviderController;
use App\Http\Controllers\Api\Provider\EarningsController;
use App\Http\Controllers\Api\Provider\JobHistoryController as ProviderJobHistoryController;
use App\Http\Controllers\Api\Provider\LevelsController;
use App\Http\Controllers\Api\Provider\NotificationController;
use App\Http\Controllers\Api\Provider\PaymentsController as ProviderPaymentsController;
use App\Http\Controllers\Api\Provider\QuestionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Broadcast::routes(['middleware' => ['auth:sanctum']]);

// Terms & Conditions
Route::get('/terms-and-conditions/{type}', [TermAndConditionController::class, 'termsAndConditions']);

// Privacy Policy
Route::get('/privacy-policy/{type}', [PrivacyPolicyController::class, 'privacyPolicy']);

// Customer Side
// Below API's are also used for customer creation by provider

//**************************************** Authentication ***********************************************//
Route::post('/verify-email-and-phone-number', [CustomerAuthenticationController::class, 'verifyEmailAndPhoneNumber']);
Route::post('/verify-phone-number', [CustomerAuthenticationController::class, 'phoneNumberVerification']);
Route::post('/signup', [CustomerAuthenticationController::class, 'addProfileDetail']);

// For both customer and provider
Route::post('/login', [CustomerAuthenticationController::class, 'login']);

//**************************************** ForgetPassword ***********************************************//
// For both customer and provider
Route::post('/send-otp-on-phone-number', [ForgetPasswordController::class, 'sendOtpOnPhoneNumber']);
Route::post('/reset-passowrd', [ForgetPasswordController::class, 'resetPassword']);
Route::post('/update-password', [ForgetPasswordController::class, 'updatePassword']);

Route::middleware('auth:sanctum')->group(function () {

    //******************************** Properties ****************************************************//
    Route::post('/properties', [PropertiesController::class, 'getProperties']);
    Route::post('/add-properties', [PropertiesController::class, 'addProperties']);
    Route::delete('/delete-properties/{id}', [PropertiesController::class, 'deleteProperty']);

    //******************************** M $ P pay *****************************************************//
    Route::get('/cards-and-wallet', [PaymentsController::class, 'cardsAndWallet']);

    Route::post('/update-wallet-setting', [PaymentsController::class, 'updateWalletSetting']);
    Route::post('/add-card', [PaymentsController::class, 'addCard']);
    Route::get('/card-default/{id}', [PaymentsController::class, 'makeDefaultCard']);
    Route::post('/delete-card/{id}', [PaymentsController::class, 'deleteCard']);

    //******************************** Payments *****************************************************//
    Route::post('/purchase', [PaymentsController::class, 'purchase']);

    //******************************** FAQs **********************************************************//
    // For both customer and provider
    Route::post('/faqs', [FAQsController::class, 'faqs']);

    //******************************** Profile Update ************************************************//
    // For both customer and provider
    Route::post('/edit-profile-detail', [CustomerAuthenticationController::class, 'editProfileDetail']);
    Route::post('/verify-email-index', [CustomerAuthenticationController::class, 'emailVerificationIndex']);
    Route::post('/verify-email', [CustomerAuthenticationController::class, 'emailVerification']);
    Route::post('/edit-password', [CustomerAuthenticationController::class, 'editPassword']);
    Route::post('/edit-email', [CustomerAuthenticationController::class, 'editEmail']);
    Route::post('/edit-email-verify', [CustomerAuthenticationController::class, 'editEmailVerification']);
    Route::post('/edit-phone-number', [CustomerAuthenticationController::class, 'editPhoneNumber']);
    Route::post('/edit-phone-number-verify', [CustomerAuthenticationController::class, 'editPhoneNumberVerification']);

    //******************************** Order service => Lawn Mowing **********************************//
    Route::get('/sizes-heights-prices', [LawnMowingController::class, 'getSizesAndPrices']);
    Route::post('/lawn-size-cleanup-price', [LawnMowingController::class, 'lawnSizeAndPrices']);
    Route::post('/service-estimations', [LawnMowingController::class, 'serviceEstimations']);
    Route::post('/order-summary', [LawnMowingController::class, 'orderSummary']);
    Route::post('/update-tip', [LawnMowingController::class, 'updateTip']);
    Route::post('/apply-coupon-discount', [LawnMowingController::class, 'applyCouponDiscount']);
    Route::post('/remove-coupon-discount', [LawnMowingController::class, 'removeCouponDiscount']);
    Route::post('/pay', [LawnMowingController::class, 'pay']);

    //******************************** Order service => Snow Plowing **********************************//
    Route::post('/cars-and-schedule', [SnowPlowingController::class, 'carsAndSchedule']);
    Route::post('/get-order-summary', [SnowPlowingController::class, 'orderSummary']);
    Route::post('/update-tip', [SnowPlowingController::class, 'updateTip']);
    Route::post('/apply-coupon-discount', [SnowPlowingController::class, 'applyCouponDiscount']);
    Route::post('/remove-coupon-discount', [SnowPlowingController::class, 'removeCouponDiscount']);
    Route::post('/pay', [SnowPlowingController::class, 'pay']);

    //******************************** Ratings ************************************************//\
    Route::post('/ratings/{id}', [RatingsController::class, 'ratingAndReview']);

    // Mark job as completed
    Route::get('/mark-job-as-completed/{id}',[JobHistoryController::class,'markJobAsCompleted']);

    //********************************  Appointments => Jobs ******************************************//
    Route::get('/jobs/{jobType}', [JobHistoryController::class, 'jobs']);

    // For both Customer and Provider
    Route::get('/jobs/details/{id}', [JobHistoryController::class, 'jobsDetails']);

    Route::post('/jobs/{id}/update-instructions', [JobHistoryController::class, 'updateInstructions']);
    Route::get('/jobs/cancel/{id}', [JobHistoryController::class, 'cancelJob']);

    // Upcoming Jobs
    Route::post('/upcoming-jobs/proposals', [JobHistoryController::class, 'upcomingJobsProposals']);

    // Accept and Decline Proposal
    Route::post('/accept-proposal/{id}', [JobHistoryController::class, 'acceptProposal']);
    Route::post('/decline-proposal/{id}', [JobHistoryController::class, 'declineProposal']);

    Route::get('/upcoming-jobs/toggle-favorite-provider/{id}', [JobHistoryController::class, 'toggleFavoriteProvider']);

    // For both Customer as Ongoing Jobs and Provider as Active Jobs
    Route::get('/ongoing-jobs/details/{id}', [JobHistoryController::class, 'ongoingJobsDetails']);

    // Provider Last Location
    Route::get('/provider-last-known-location/{id}', [JobHistoryController::class, 'providerLastLocation']);

    // Favorite Provider
    Route::get('/favorite-providers', [FavoriteProvidersController::class, 'favoriteProviders']);
    Route::get('/providers/details/{id}', [JobHistoryController::class, 'providerDetails']);

    //******************************************* Customer Support **********************************************//
    // For both customer and provider
    Route::post('/support-ticket', [SupportController::class, 'customerSupportTicket']);

    // Customer's Chat
    Route::group(['prefix' => 'customers-chat','as' => 'customers-chat.'], function () {
        Route::get('/{order_id}',[JobHistoryController::class,'customersChat']);
        Route::post('/send-message',[JobHistoryController::class,'sendMessage']);
    });

    // Get data like login api response
    Route::get('/get-response-like-login', [CustomerAuthenticationController::class, 'getDataLikeLogin']);

    //*********************************************** LogOut ********************************************//
    Route::post('/logout', [CustomerAuthenticationController::class, 'logout']);

    //*********************************************** Delete Account ********************************************//
    // For both customer and provider
    Route::post('/delete-account', [CustomerAuthenticationController::class, 'deleteAccount']);


});

// Provider Side
//**************************************** Authentication ***********************************************//
Route::group(['prefix' => 'provider'], function () {

    Route::post('/email-and-phone-number', [ProviderAuthenticationController::class, 'emailAndPhoneNumber']);
    Route::post('/verify-phone-number', [ProviderAuthenticationController::class, 'phoneNumberVerification']);
    Route::post('/signup', [ProviderAuthenticationController::class, 'addProfileDetail']);

    Route::middleware('auth:sanctum')->group(function () {

        // Total Jobs , Available Jobs , Completed Jobs and Active Jobs
        Route::post('/jobs', [ProviderJobHistoryController::class, 'jobs']);

        // Special Api for available jobs quantity ranging from 0 to 2
        Route::get('/available-jobs', [ProviderJobHistoryController::class, 'availableJobsAndRatings']);

        // Proposal send by Provider
        Route::post('/send-proposal',[ProviderJobHistoryController::class, 'sendProposal']);

        // Active Job from On-My-Way To Complete Job
        Route::post('/active-job/{type}/{id}',[ProviderJobHistoryController::class, 'completeActiveJob']);

        // Provider's Reviews
        Route::get('/reviews-and-level',[ProviderRatingController::class, 'totalReviewsAndLevel']);

        // Total Earnings
        Route::get('/earnings',[EarningsController::class,'totalEarnings']);

        // About us
        Route::get('/about-us',[AboutUsController::class,'aboutUs']);

        // Update Provider location
        Route::post('/update-provider-location',[ProviderJobHistoryController::class,'updateProviderLastKnownLocation']);

        // Prodiver's Chat
        Route::group(['prefix' => 'providers-chat','as' => 'providers-chat.'], function () {
            Route::get('/{order_id}',[ProviderJobHistoryController::class,'providersChat']);
            Route::post('/send-message',[ProviderJobHistoryController::class,'sendMessage']);
        });

        // Provider's Levels
        Route::get('/levels',[LevelsController::class,'getLevels']);

        // Customer's list created by Provider
        Route::get('/customers-list',[CustomerByProviderController::class,'customersCreatedByProvider']);

        // Job Created By Provider For his Customer
        Route::post('/order-by-provider',[CustomerByProviderController::class,'orderByProvider']);
        Route::post('/add-card-and-pay',[CustomerByProviderController::class,'addCardAndPay']);

        // Stripe Account created for provider
        Route::post('/add-stripe-account',[ProviderPaymentsController::class,'addStripeAccount']);

        // Delete Stripe account
        Route::delete('/delete-account/{id}/{account_id}', [ProviderPaymentsController::class, 'deleteAccount']);

        // Get account
        Route::get('/get-account',[ProviderPaymentsController::class,'getStripeAccount']);

        // Notifications for both Customer and Provider
        Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
            Route::get('/',[NotificationController::class,'getNotifications']);
            Route::get('/update-status',[NotificationController::class,'updateStatus']);
            Route::delete('/delete/{id}', [NotificationController::class, 'deleteNotification']);
        });

        // Questions at job completion
        Route::get('/questions/{category}',[QuestionController::class,'getQuestions']);

    });
});

