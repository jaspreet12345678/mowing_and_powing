<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\CompanySettingsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FavoriteProvidersController;
use App\Http\Controllers\Admin\LawnMovingController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PluginsController;
use App\Http\Controllers\Admin\ProvidersController;
use App\Http\Controllers\Admin\RefferalController;
use App\Http\Controllers\Admin\RolesAndPermissionsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SnowPlowingController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\RecurringJobsController;
use App\Http\Controllers\Admin\PayProviderController;
use App\Http\Controllers\Admin\FooterScriptController;
use App\Http\Controllers\Admin\CouponCodeController;
use App\Http\Controllers\Admin\FAQsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\PrivacyPloicyController;
use App\Http\Controllers\Admin\TermAndConditionController;
use App\Http\Controllers\Admin\CancelJobsController;
use App\Http\Controllers\Admin\SupportController;

use Illuminate\Support\Facades\Route;



Route::get('/admin', function () {
    return redirect(route('admin.login'));
});

// Authentications
Route::get('admin/login', [AuthenticationController::class, 'loginIndex'])->name('admin.login');
Route::post('admin/login', [AuthenticationController::class, 'login']);

// Forget password
Route::group(['prefix' => 'admin/forget-password','as' => 'admin.forget-password.'], function () {
    Route::get('email', [AuthenticationController::class, 'resetPasswordEmail'])->name('email');
    Route::get('verify-email', [AuthenticationController::class, 'verifyResetPasswordEmailIndex'])->name('verify-email.index');
    Route::post('verify-email', [AuthenticationController::class, 'verifyResetPasswordEmail'])->name('verify-email');
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordIndex'])->name('reset-password.index');
    Route::post('reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');
});

//Logout
Route::post('admin/logout', [AuthenticationController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin','authenticate:admin']], function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('dashboard/{status}', [DashboardController::class, 'getEarningBYDate'])->name('dashboard.get_by_date');
    Route::get('edit-profile', [AdminsController::class, 'editProfile'])->name('edit-profile');
    Route::post('update-profile', [AdminsController::class, 'updateProfile'])->name('update-profile');

    // Users
    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'permission:users'], function () {
        Route::group(['prefix' => 'provider', 'as' => 'provider.', 'middleware' => 'permission:provider'], function () {
            Route::post('signup-step1', [ProvidersController::class, 'signUp'])->name('signup-step1');
            Route::get('verify-email', [ProvidersController::class, 'verifyEmailIndex'])->name('verify-email');
            Route::post('verify-email', [ProvidersController::class, 'verifyEmail']);
            Route::get('verify-phone-number', [ProvidersController::class, 'verifyPhoneNumberIndex'])->name('verify-phone-number');
            Route::post('verify-phone-number', [ProvidersController::class, 'verifyPhoneNumber']);
            Route::get('register-provider', [ProvidersController::class, 'registerNewProvider'])->name('register-provider');
            Route::post('save-provider', [ProvidersController::class, 'Store'])->name('save-provider');
            Route::post('resend-code', [ProvidersController::class, 'resendCode'])->name('resend-code');
        });
        // Admins
        Route::get('admins/data', [AdminsController::class, 'data'])->name('admins.data');
        Route::resource('admins', AdminsController::class);
        Route::get('customers', [CustomersController::class, 'index'])->name('customers.index');

        Route::get('add_new_customer', [CustomersController::class, 'addNewCustomer'])->name('add_new_customer');
        Route::get('register-customer', [CustomersController::class, 'registerNewCustomer'])->name('register-customer');

        Route::post('signup-step1', [CustomersController::class, 'signUp'])->name('signup-step1');
        Route::get('verify-email', [CustomersController::class, 'verifyEmailIndex'])->name('verify-email');
        Route::post('verify-email', [CustomersController::class, 'verifyEmail']);
        Route::get('verify-phone-number', [CustomersController::class, 'verifyPhoneNumberIndex'])->name('verify-phone-number');
        Route::post('verify-phone-number', [CustomersController::class, 'verifyPhoneNumber']);
        Route::post('save-customers', [CustomersController::class, 'Store'])->name('save-customers');
        Route::post('customers/resend-code', [CustomersController::class, 'resendCode'])->name('customers.resend-code');

        Route::get('add_new_provider', [ProvidersController::class, 'addNewProvider'])->name('add_new_provider');
        Route::post('edit-profile', [CustomersController::class, 'updateProfile'])->name('edit-profile');
        Route::get('customers/data', [CustomersController::class, 'data'])->name('customers.data');
        Route::get('customers/block/{id}', [CustomersController::class, 'blockUser'])->name('customers.block');
        Route::get('customers/send_email/{id}', [CustomersController::class, 'sendEmailToSingleCustomer'])->name('customers.send_semail');
        Route::get('customers/active/{id}', [CustomersController::class, 'activeUser'])->name('customers.active');
        Route::delete('customers/destroy/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
        Route::get('pending_customer', [CustomersController::class, 'pendingCustomer'])->name('pending_customer');
        Route::get('block_customer', [CustomersController::class, 'blockCustomer'])->name('block_customer');
        Route::get('customers/show/{id}', [CustomersController::class, 'showUserDetail'])->name('customers.show');
        // Route::post('customers/update-profile', [CustomersController::class, 'UpdateProfile'])->name('customers.update-profile');
        Route::get('/providers/index', [ProvidersController::class, 'index'])->name('providers.index');
        Route::get('pending_providers', [ProvidersController::class, 'pendingProviders'])->name('pending_providers');
        Route::get('block_providers', [ProvidersController::class, 'blockProviders'])->name('block_providers');

        Route::get('providers/data', [ProvidersController::class, 'data'])->name('providers.data');
        Route::delete('providers/destroy/{id}', [ProvidersController::class, 'destroy'])->name('providers.destroy');
        Route::get('providers/show/{id}', [ProvidersController::class, 'showUserDetail'])->name('providers.show');
        Route::get('providers/send_email/{id}', [ProvidersController::class, 'sendEmailToSingleProvider'])->name('providers.send_email');
        Route::get('providers/block/{id}', [ProvidersController::class, 'blockUser'])->name('providers.block');
        Route::get('providers/active/{id}', [ProvidersController::class, 'activeUser'])->name('providers.active');
    });

    // Teams
    Route::group(['middleware' => 'permission:teams'], function () {

        Route::get('teams/data', [TeamsController::class, 'data'])->name('teams.data');
        Route::get('teams/invite', [TeamsController::class, 'inviteIndex'])->name('teams.invite.index');
        Route::post('teams/invite', [TeamsController::class, 'invite'])->name('teams.invite');
        Route::get('teams/permissions/{role}', [TeamsController::class, 'permissions'])->name('teams.permissions');
        Route::resource('/teams', TeamsController::class);
    });

    // Roles and Permissions
    Route::group(['middleware' => 'permission:roles_and_permissions'], function () {

        Route::get('/roles-and-permissions/data', [RolesAndPermissionsController::class, 'data'])->name('roles-and-permissions.data');
        Route::get('/roles-and-permissions/permissions/{role_id}', [RolesAndPermissionsController::class, 'permissions'])->name('roles-and-permissions.permissions');
        Route::put('/roles-and-permissions/permissions/{role_id}', [RolesAndPermissionsController::class, 'updatePermissions'])->name('roles-and-permissions.permissions.update');
        Route::resource('/roles-and-permissions', RolesAndPermissionsController::class);
    });

    // Plugins
    Route::group(['prefix' => 'plugins', 'as' => 'plugins.', 'middleware' => ['permission:plugins']], function () {

        Route::get('/', [PluginsController::class, 'index'])->name('index');
        Route::get('/{plugin}', [PluginsController::class, 'plugin'])->name('plugin');
        Route::put('/update', [PluginsController::class, 'update'])->name('update');
    });

    // Templates
    Route::group(['prefix' => 'templates', 'as' => 'templates.', 'middleware' => 'permission:templates'], function () {

        Route::get('email/{template?}', [TemplateController::class, 'emailTemplates'])->name('email');
        Route::post('save-email-template/{name}', [TemplateController::class, 'saveEmailTemplate'])->name('save-email-template');
        Route::get('sms/{template?}', [TemplateController::class, 'smsTemplates'])->name('sms');
        Route::post('save-sms-template/{name}', [TemplateController::class, 'saveSmsTemplate'])->name('save-sms-template');
    });

    //Favorite Providers
    Route::group(['prefix' => 'favorite-providers', 'as' => 'favorite-providers.'], function () {

        Route::get('/', [FavoriteProvidersController::class, 'index'])->name('index');
        Route::get('/details/{id}', [FavoriteProvidersController::class, 'providerDetails'])->name('details');
    });
    //Footer Script
    Route::get('footer-script', [FooterScriptController::class, 'index'])->name('footer-script');
    Route::post('store-footer-script', [FooterScriptController::class, 'storeFooterScrpt'])->name('store-footer-script');

    //Citoies Routes
    Route::group(['prefix' => 'cities', 'as' => 'cities.'], function () {
        Route::get('index', [CitiesController::class, 'index'])->name('index');
        Route::get('add-city',[CitiesController::class, 'addCityIndexPage'])->name('add-city');
        Route::post('store',[CitiesController::class, 'Store'])->name('store');
        Route::delete('delete-city/{id}', [CitiesController::class, 'deleteCity'])->name('delete-city');
        Route::get('view-city/{id}', [CitiesController::class, 'ViewCity'])->name('view-city');
        Route::post('update',[CitiesController::class, 'updateCity'])->name('update');

    });

    Route::group(['prefix' => 'refferal-system', 'as' => 'refferal-system.'], function () {
        Route::get('index', [RefferalController::class, 'index'])->name('index');
    });

    //Chat Routes
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::get('chat_message/{id}',[ChatController::class, 'getChatMessage'])->name('chat_message');
    // FAQs
    Route::group(['prefix' => 'faqs', 'as' => 'faqs.'], function () {
        // Route::get('/{type}', [FAQsController::class, 'index'])->name('index');
        Route::get('get_faq/{type}', [FAQsController::class, 'index'])->name('get_faq');
        Route::get('view-faq/{id}', [FAQsController::class, 'ViewFaq'])->name('view-faq');
        Route::delete('delete-faq/{id}', [FAQsController::class, 'deleteFaq'])->name('delete-faq');

        Route::get('add-faq/{type}', [FAQsController::class, 'addFaq'])->name('add-faq');
        Route::post('update-faq', [FAQsController::class, 'updateFaqDetail'])->name('update-faq');


    });

    //About Us
    Route::group(['prefix' => 'about-us', 'as' => 'about-us.'], function () {
        Route::get('/', [AboutUsController::class, 'index'])->name('index');
        Route::post('save-detail', [AboutUsController::class, 'storeAbouUsDetail'])->name('save-detail');
    });


    Route::group(['prefix' => 'support', 'as' => 'support.'], function () {
        Route::get('/', [SupportController::class, 'index'])->name('index');
        Route::get('app-flow', [SupportController::class, 'appFlow'])->name('app-flow');
        Route::get('see-detail/{id}', [SupportController::class, 'seeSupportsDetail'])->name('see-detail');
    });

    //Privacy Policies
    Route::group(['prefix' => 'privacy-policy', 'as' => 'privacy-policy.'], function () {
        Route::get('/{type}', [PrivacyPloicyController::class, 'index'])->name('index');
        Route::post('save-detail', [PrivacyPloicyController::class, 'storePrivacyDetail'])->name('save-detail');
    });

    //Terms And Condition
    Route::group(['prefix' => 'term-and-condition', 'as' => 'term-and-condition.'], function () {
        Route::get('/{type}', [TermAndConditionController::class, 'index'])->name('index');
        Route::post('save-detail', [TermAndConditionController::class, 'storeTermAndConditionDetail'])->name('save-detail');
    });

    // Coupon Code
    Route::group(['prefix' => 'coupon-code', 'as' => 'coupon-code.', 'middleware' => 'permission:coupon-code'], function () {
        Route::get('index', [CouponCodeController::class, 'index'])->name('index');
        Route::get('add-coupon', [CouponCodeController::class, 'addNewCoupon'])->name('add-coupon');
        Route::get('edit-coupon/{id}', [CouponCodeController::class, 'editCoupon'])->name('edit-coupon');
        Route::get('coupon-delete-warning/{id}', [CouponCodeController::class, 'couponDeleteWarning'])->name('coupon-delete-warning');
        Route::post('update-coupon', [CouponCodeController::class, 'UpdateCouponCode'])->name('update-coupon');
        Route::post('store', [CouponCodeController::class, 'storeCouponCode'])->name('store');
        Route::get('delete/{id}', [CouponCodeController::class, 'Delete'])->name('delete');
    });

    //Orders
    Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => 'permission:orders'], function () {
        Route::get('orders/{status}', [OrdersController::class, 'index'])->name('orders');
        Route::get('upload_before_service_image/{order_id}/{provider_id}/{type}', [OrdersController::class, 'uploadBeforeServiceImage'])->name('upload_before_service_image');
        Route::post('upload_provider_images',[OrdersController::class, 'uploadProviderImages'])->name('upload_provider_images');


        Route::get('view-detail/{id}/{status}', [OrdersController::class, 'viewDetail'])->name('view-detail');
        Route::get('proposals', [OrdersController::class, 'upcomingJobsProposals'])->name('proposals');
        Route::get('provider-assign/{id}', [OrdersController::class, 'assignProvider'])->name('provider-assign');
        Route::post('update-assign-provider', [OrdersController::class, 'updateAssignProvider'])->name('update-assign-provider');
        Route::get('/jobs/cancel-warning/{id}', [OrdersController::class, 'cancelJobWarning'])->name('jobs.cancel-warning');
        Route::get('/jobs/remove_provider_warning/{id}', [OrdersController::class, 'removeProviderWarning'])->name('jobs.remove_provider_warning');

        Route::get('/jobs/re_post_job/{id}', [OrdersController::class, 'rePostJobWarning'])->name('jobs.re_post_job');
        Route::get('/jobs/cancel/{id}', [OrdersController::class, 'cancelJob'])->name('jobs.cancel');
        Route::get('/jobs/repost/{id}', [OrdersController::class, 'rePostJob'])->name('jobs.repost');
        Route::get('/jobs/RemoveProvider/{id}', [OrdersController::class, 'RemoveProvider'])->name('jobs.RemoveProvider');

        Route::post('change-order-status', [OrdersController::class, 'changeOrderStatus'])->name('change-order-status');
        Route::post('update-customer-instruction', [OrdersController::class, 'updateCustomerInstruction'])->name('update-customer-instruction');
    });

    //Cancel Jobs
     //Recurring Jobs
     Route::group(['prefix' => 'cancel-jobs', 'as' => 'cancel-jobs.', 'middleware' => 'permission:cancel-jobs'], function () {
        Route::get('index', [CancelJobsController::class, 'index'])->name('index');
        Route::get('refund/{id}', [CancelJobsController::class, 'RefundCancelJob'])->name('refund');
        Route::get('review/{id}', [CancelJobsController::class, 'ReviewCancelJob'])->name('review');
        Route::get('refunded-job', [CancelJobsController::class, 'refundedJobs'])->name('refunded-job');
        Route::get('reviewed-job', [CancelJobsController::class, 'reviewedJobs'])->name('reviewed-job');
    });


    //Recurring Jobs
    Route::group(['prefix' => 'recurring-jobs', 'as' => 'recurring-jobs.', 'middleware' => 'permission:recurring-jobs'], function () {
        Route::get('index/{status}', [RecurringJobsController::class, 'index'])->name('index');
        Route::get('job-detail/{id}', [RecurringJobsController::class, 'viewJobDetail'])->name('job-detail');
        Route::get('order_list/{id}', [RecurringJobsController::class, 'orderList'])->name('order_list');
        Route::get('cancel-warning/{id}', [RecurringJobsController::class, 'cancelJobWarning'])->name('cancel-warning');
        Route::post('cancel', [RecurringJobsController::class, 'cancelJob'])->name('cancel');



    });





    //Pay Providers
    Route::group(['prefix' => 'payproviders', 'as' => 'payproviders.', 'middleware' => 'permission:payproviders'], function () {
        Route::get('payment-status/{status}', [PayProviderController::class, 'getProviderByPaymentStatus'])->name('payment-status');
        Route::get('paid-providers/{status}', [PayProviderController::class, 'getPaidProviders'])->name('paid-providers');

        Route::get('view_payment_approved/{id}', [PayProviderController::class, 'viewPaymentApproved'])->name('view_payment_approved');
        Route::get('view_payment_reject/{id}', [PayProviderController::class, 'viewPaymentReject'])->name('view_payment_reject');

        Route::get('payment-approved/{id}', [PayProviderController::class, 'paymentApproved'])->name('payment-approved');
        Route::get('payment-review/{id}', [PayProviderController::class, 'paymentReview'])->name('payment-review');
        Route::get('payment-reject/{id}', [PayProviderController::class, 'paymentReject'])->name('payment-reject');

    });

    //General Setting
    Route::group(['prefix' => 'generalsettings', 'as' => 'generalsettings.', 'middleware' => 'permission:generalsettings'], function () {

        // ***********************************Snow Plowing***********************************************************
        Route::group(['prefix' => 'snow-plowing', 'as' => 'snow-plowing.', 'middleware' => 'permission:snow-plowing'], function () {
            Route::post('update-charges', [SnowPlowingController::class, 'updateCharges'])->name('update-charges');
            Route::get('show-cards', [SnowPlowingController::class, 'showCards'])->name('show-cards');
            Route::get('snow-setting/{type}', [SnowPlowingController::class, 'snowSetting'])->name('snow-setting');
            Route::get('cards-value/{type}', [SnowPlowingController::class, 'GetCardsValueByType'])->name('cards-value');
            Route::get('edit-questions/{id}', [SnowPlowingController::class, 'editQuestion'])->name('edit-questions');
            Route::get('add-question', [SnowPlowingController::class, 'addQuestion'])->name('add-question');
            Route::post('add-question', [SnowPlowingController::class, 'addSnowPlowingQuestion'])->name('add-question');
            Route::post('update-question', [SnowPlowingController::class, 'updateSnowPlowingQuestion'])->name('update-question');
            Route::delete('delete-question/{id}', [SnowPlowingController::class, 'DeleteQuestuion'])->name('delete-question');
            Route::post('add-car-color', [SnowPlowingController::class, 'addCarColor'])->name('add-car-color');
            Route::post('add-car-type', [SnowPlowingController::class, 'addCarType'])->name('add-car-type');
            Route::get('view-car-color', [SnowPlowingController::class, 'viewCarColor'])->name('view-car-color');
            Route::get('view-car-type', [SnowPlowingController::class, 'viewCarType'])->name('view-car-type');
            Route::get('edit-car-color/{id}', [SnowPlowingController::class, 'editCarColor'])->name('edit-car-color');
            Route::get('edit-car-type/{id}', [SnowPlowingController::class, 'editCarType'])->name('edit-car-type');
            Route::delete('delete-car-type/{id}', [SnowPlowingController::class, 'DeleteCarType'])->name('delete-car-type');
            Route::delete('delete-car-color/{id}', [SnowPlowingController::class, 'DeleteCarColor'])->name('delete-car-color');
            Route::post('update-car-color', [SnowPlowingController::class, 'updateCarColor'])->name('update-car-color');
            Route::post('update-car-type', [SnowPlowingController::class, 'updateCarType'])->name('update-car-type');
            Route::get('drive-way/{id}', [SnowPlowingController::class, 'getDriverWay'])->name('drive-way');
            Route::post('update-drive-way', [SnowPlowingController::class, 'updateDriverWay'])->name('update-drive-way');
            Route::get('side-walk/{id}', [SnowPlowingController::class, 'getSideWalk'])->name('side-walk');
            Route::post('update-side-walk', [SnowPlowingController::class, 'updateSideWalk'])->name('update-side-walk');
            Route::get('walk-way/{id}', [SnowPlowingController::class, 'getWalkWay'])->name('walk-way');
            Route::get('snow-depth/{id}', [SnowPlowingController::class, 'getSnowDepth'])->name('snow-depth');
            Route::post('update-walk-way', [SnowPlowingController::class, 'updateWalkWay'])->name('update-walk-way');
            Route::post('update-snow-depth', [SnowPlowingController::class, 'updateSnowDepth'])->name('update-snow-depth');
            Route::post('add_property', [CustomersController::class, 'addCustomerProperties'])->name('add_property');
            Route::delete('delete-property/{id}',[CustomersController::class,'deleteProperty'])->name('delete-property');

        });

        //  Setting Routes
        Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => 'permission:setting'], function () {
            Route::get('show-setting', [SettingController::class, 'settingView'])->name('show-setting');
            Route::get('show-model/{status}', [SettingController::class, 'showModel'])->name('show-model');
            Route::post('update-setting', [SettingController::class, 'updateSetting'])->name('update-setting');
        });
        // Lawn Mowing Routes
    Route::group(['prefix' => 'lawnmoving', 'as' => 'lawnmoving.', 'middleware' => 'permission:lawnmoving'], function () {

        Route::post('update-charges', [LawnMovingController::class, 'updateCharges'])->name('update-charges');
        Route::get('show-cards', [LawnMovingController::class, 'showCards'])->name('show-cards');
        Route::get('getlawmovingfee/{type}', [LawnMovingController::class, 'getlawmovingfee'])->name('getlawmovingfee');
        Route::put('update', [LawnMovingController::class, 'feeupdate'])->name('update');
        Route::get('lawn-size/{type}', [LawnMovingController::class, 'lawnSize'])->name('lawn-size');
        Route::get('get-lawn-data', [LawnMovingController::class, 'getLawndata'])->name('get-lawn-data');
        Route::get('get-lawn-height-data', [LawnMovingController::class, 'getLawnHeightData'])->name('get-lawn-height-data');
        Route::get('get-fence-data', [LawnMovingController::class, 'getFenceData'])->name('get-fence-data');
        Route::get('edit-lawn-cleanup/{id}', [LawnMovingController::class, 'editLawnCleanUp'])->name('edit-lawn-cleanup');
        Route::put('update-cleanup', [LawnMovingController::class, 'updateCleanUp'])->name('update-cleanup');
        Route::post('update-lawn-moving-size', [LawnMovingController::class, 'updateLawnMovingSize'])->name('update-lawn-moving-size');
        Route::post('add-lawn-moving-height', [LawnMovingController::class, 'addLawnMovingHeight'])->name('add-lawn-moving-height');
        Route::post('add-lawn-moving-size', [LawnMovingController::class, 'addLawnMovingSize'])->name('add-lawn-moving-size');
        Route::post('update-lawn-moving-height', [LawnMovingController::class, 'updateLawnMovingHeight'])->name('update-lawn-moving-height');
        Route::get('add-lawn-size', [LawnMovingController::class, 'addLwanSize'])->name('add-lawn-size');
        Route::get('add-lawn-height', [LawnMovingController::class, 'addLwanHeight'])->name('add-lawn-height');
        Route::get('edit-lawn-size/{id}', [LawnMovingController::class, 'editLawnSize'])->name('edit-lawn-size');
        Route::get('edit-lawn-height/{id}', [LawnMovingController::class, 'editLawnHeight'])->name('edit-lawn-height');
        Route::get('edit-fence-data/{id}', [LawnMovingController::class, 'editFenceData'])->name('edit-fence-data');
        Route::post('update-fence', [LawnMovingController::class, 'updateFenceData'])->name('update-fence');

        Route::delete('delete-fence-data/{id}', [LawnMovingController::class, 'deleteFenceData'])->name('delete-fence-data');
        Route::get('edit-questions/{id}', [LawnMovingController::class, 'editQuestion'])->name('edit-questions');
        Route::put('update-lawnmpving-question', [LawnMovingController::class, 'updateLawnMovingQuestion'])->name('update-lawnmpving-question');
        Route::delete('delete-question/{id}', [LawnMovingController::class, 'deleteQuestion'])->name('delete-question');
        Route::delete('delete-lawn-size/{id}', [LawnMovingController::class, 'deleteLawnSize'])->name('delete-lawn-size');
        Route::delete('delete-lawn-height/{id}', [LawnMovingController::class, 'deleteLawnHeight'])->name('delete-lawn-height');
        Route::put('update-cornerlot', [LawnMovingController::class, 'updateCornerLot'])->name('update-cornerlot');
        Route::POST('change-service-status/{id}', [LawnMovingController::class, 'updateServiceStatus'])->name('change-service-status');
    });
    });



    // Company settings
    Route::resource('company-settings', CompanySettingsController::class)->middleware('permission:company_settings');
});
