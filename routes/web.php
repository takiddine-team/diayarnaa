<?php

use App\Models\Opinion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ResetPassword;
use App\Http\Controllers\Backend\Admin\JobController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\AboutController;
use App\Http\Controllers\Backend\Admin\TargetController;
use App\Http\Controllers\Backend\Admin\FeatureController;
use App\Http\Controllers\Backend\Admin\OpinionController;
use App\Http\Controllers\Backend\Admin\ComplaintController;
use App\Http\Controllers\Backend\Admin\ContactUsController;
use App\Http\Controllers\Backend\Admin\AdminLoginController;
use App\Http\Controllers\Backend\Admin\HomeSliderController;
use App\Http\Controllers\Backend\Admin\JobRequestController;
use App\Http\Controllers\Backend\Admin\NewsletterController;
use App\Http\Controllers\Frontend\RealEstateOwnerController;
use App\Http\Controllers\Backend\Admin\FeatureTypeController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\RealEstateOfficeController;
use App\Http\Controllers\Frontend\RealEstateSeekerController;
use App\Http\Controllers\Backend\Admin\DiyarnaaCityController;
use App\Http\Controllers\Backend\Admin\MainCategoryController;
use App\Http\Controllers\Backend\Admin\AdvertisementController;
use App\Http\Controllers\Backend\Admin\InternalMailsController;
use App\Http\Controllers\Backend\Admin\PrivacyPolicyController;
use App\Http\Controllers\Backend\Admin\SupportTicketController;
use App\Http\Controllers\Backend\Admin\WebsiteBrokerController;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;
use App\Http\Controllers\Backend\Admin\DiyarnaaRegionController;
use App\Http\Controllers\Backend\Admin\UserMembershipController;
use App\Http\Controllers\Backend\Admin\DiyarnaaCountryController;
use App\Http\Controllers\Backend\Admin\TermsConditionsController;
use App\Http\Controllers\Backend\Admin\ContactUsRequestController;
use App\Http\Controllers\Backend\Admin\PremiumMembershipController;
use App\Http\Controllers\Backend\Admin\NewsletterSubscribeController;
use App\Http\Controllers\Backend\Admin\PremiumMembershipPageController;
use App\Http\Controllers\Backend\Admin\FeatureTypeSubcategoryController;
use App\Http\Controllers\Backend\Admin\AdvertisementEditRequestController;
use App\Http\Controllers\Backend\Admin\BackgroundImageController;
use App\Http\Controllers\Backend\Admin\EmployeeController;
use App\Http\Controllers\Backend\Admin\PaymentTransactionController;
use App\Http\Controllers\Backend\Admin\SearchController;
use App\Http\Controllers\PayPal\PayPalPaymentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('process-transaction/{premium_membership_id}', [PaypalPaymentController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction/{payment_transaction}', [PaypalPaymentController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction/{payment_transaction}', [PaypalPaymentController::class, 'cancelTransaction'])->name('cancelTransaction');





// ==================================================================================================================
// =========================================== Super Admin Routes ===================================================
// ==================================================================================================================
Route::prefix('super_admin')->name('super_admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/loginSubmit', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::group(['middleware' => 'auth:super_admin'], function () {
        // Dashboard Route :
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        // Support Tickets :
        // ==============================================================================
        Route::group(['prefix' => 'support_tickets'], function () {
            Route::get('/index', [SupportTicketController::class, 'index'])->name('support_tickets-index');
            Route::get('destroy/{id}', [SupportTicketController::class, 'destroy'])->name('support_tickets-destroy');
        });
        // ==================================================================================================================
        // =========================================== User Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'users'], function () {
            Route::get('/create', [UserController::class, 'create'])->name('users-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [UserController::class, 'store'])->name('users-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [UserController::class, 'index'])->name('users-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [UserController::class, 'show'])->name('users-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('users-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [UserController::class, 'update'])->name('users-update'); // Created By Lujain Al-Smadi
            Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('users-destroy'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [UserController::class, 'softDelete'])->name('users-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [UserController::class, 'showSoftDelete'])->name('users-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [UserController::class, 'softDeleteRestore'])->name('users-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [UserController::class, 'activeInactiveSingle'])->name('users-activeInactiveSingle'); // Created By Lujain Al-Smadi
            Route::get('reject/{id}', [UserController::class, 'reject'])->name('users-reject'); // Created By Lujain Al-Smadi
            Route::get('accept/{id}', [UserController::class, 'accept'])->name('users-accept'); // Created By Lujain Al-Smadi
            Route::get('export', [UserController::class, 'export'])->name('users-export'); // Created By Lujain Al-Smadi

            Route::get('addMembership/{id}', [UserController::class, 'addMembership'])->name('users-addMembership'); // Created By Qusai
            Route::post('addMembershipRequest/{id}', [UserController::class, 'addMembershipRequest'])->name('users-addMembershipRequest'); // Created By Lujain Al-Smadi


            //Ajax Routes :
            Route::post('/getDiyarnaaCities', [UserController::class, 'getDiyarnaaCities'])->name('users-getDiyarnaaCities'); // Created By Lujain Al-Smadi
            Route::post('/getDiyarnaaRegions', [UserController::class, 'getDiyarnaaRegions'])->name('users-getDiyarnaaRegions'); // Created By Lujain Al-Smadi
        });


        Route::group(['prefix' => 'user_membership'], function () {

            Route::get('/index', [UserMembershipController::class, 'index'])->name('user_membership-index'); // Created By Lujain Al-Smadi

        });
        // ==================================================================================================================
        // =========================================== About Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'abouts'], function () {
            Route::get('/index', [AboutController::class, 'index'])->name('abouts-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [AboutController::class, 'edit'])->name('abouts-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [AboutController::class, 'update'])->name('abouts-update'); // Created By Lujain Al-Smadi
        });

        //==================================================================================================================
        // =========================================== NewsletterSubscribe Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'newsletters'], function () {
            Route::get('/newsletterSubscribers', [NewsletterSubscribeController::class, 'newsletterSubscribers'])->name('newsletters-newsletterSubscribers'); // Created By Lujain Al-Smadi
            Route::get('/newsletterForm', [NewsletterController::class, 'newsletterForm'])->name('newsletters-newsletterForm'); // Created By Lujain Al-Smadi
            Route::post('/sendNewsletter', [NewsletterController::class, 'sendNewsletter'])->name('newsletters-sendNewsletter'); // Created By Lujain Al-Smadi
        });
        // ==================================================================================================================
        // =========================================== Contact Us Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'contact_us'], function () {
            Route::get('/index', [ContactUsController::class, 'index'])->name('contact_us-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [ContactUsController::class, 'edit'])->name('contact_us-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [ContactUsController::class, 'update'])->name('contact_us-update'); // Created By Lujain Al-Smadi

        });
        // ==================================================================================================================
        // =========================================== Contact Us Request Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'contact_us_request'], function () {
            Route::get('/index', [ContactUsRequestController::class, 'index'])->name('contact_us_request-index'); // Created By Lujain Al-Smadi
            Route::get('delete/{id}', [ContactUsRequestController::class, 'destroy'])->name('contact_us_request-destroy'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [ContactUsRequestController::class, 'show'])->name('contact_us_request-show'); // Created By Lujain Al-Smadi

        });
        Route::group(['prefix' => 'complaints'], function () {
            Route::get('/index', [ComplaintController::class, 'index'])->name('complaints-index'); // Created By Lujain Al-Smadi
            Route::get('delete/{id}', [ComplaintController::class, 'destroy'])->name('complaints-destroy'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [ComplaintController::class, 'show'])->name('complaints-show'); // Created By Lujain Al-Smadi

        });

        //==================================================================================================================
        // ===========================================Jobs Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'jobs'], function () {
            Route::get('/create', [JobController::class, 'create'])->name('jobs-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [JobController::class, 'store'])->name('jobs-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [JobController::class, 'index'])->name('jobs-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [JobController::class, 'show'])->name('jobs-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [JobController::class, 'edit'])->name('jobs-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [JobController::class, 'update'])->name('jobs-update'); // Created By Lujain Al-Smadi

            Route::get('softDelete/{id}', [JobController::class, 'softDelete'])->name('jobs-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [JobController::class, 'showSoftDelete'])->name('jobs-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [JobController::class, 'softDeleteRestore'])->name('jobs-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [JobController::class, 'activeInactiveSingle'])->name('jobs-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        //==================================================================================================================
        // ===========================================Terms and Conditions Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'terms_conditions'], function () {
            Route::get('/create', [TermsConditionsController::class, 'create'])->name('terms_conditions-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [TermsConditionsController::class, 'store'])->name('terms_conditions-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [TermsConditionsController::class, 'index'])->name('terms_conditions-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [TermsConditionsController::class, 'show'])->name('terms_conditions-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [TermsConditionsController::class, 'edit'])->name('terms_conditions-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [TermsConditionsController::class, 'update'])->name('terms_conditions-update'); // Created By Lujain Al-Smadi

            Route::get('softDelete/{id}', [TermsConditionsController::class, 'softDelete'])->name('terms_conditions-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [TermsConditionsController::class, 'showSoftDelete'])->name('terms_conditions-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [TermsConditionsController::class, 'softDeleteRestore'])->name('terms_conditions-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [TermsConditionsController::class, 'activeInactiveSingle'])->name('terms_conditions-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        // ================================================Privacy Routes :
        Route::group(['prefix' => 'privacy_policy'], function () {
            Route::get('/create', [PrivacyPolicyController::class, 'create'])->name('privacy_policy-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [PrivacyPolicyController::class, 'store'])->name('privacy_policy-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [PrivacyPolicyController::class, 'index'])->name('privacy_policy-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [PrivacyPolicyController::class, 'show'])->name('privacy_policy-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [PrivacyPolicyController::class, 'edit'])->name('privacy_policy-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [PrivacyPolicyController::class, 'update'])->name('privacy_policy-update'); // Created By Lujain Al-Smadi

            Route::get('softDelete/{id}', [PrivacyPolicyController::class, 'softDelete'])->name('privacy_policy-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [PrivacyPolicyController::class, 'showSoftDelete'])->name('privacy_policy-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [PrivacyPolicyController::class, 'softDeleteRestore'])->name('privacy_policy-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [PrivacyPolicyController::class, 'activeInactiveSingle'])->name('privacy_policy-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        // ================================================Target Routes :
        // ==============================================================================
        Route::group(['prefix' => 'targets'], function () {
            Route::get('/create', [TargetController::class, 'create'])->name('targets-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [TargetController::class, 'store'])->name('targets-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [TargetController::class, 'index'])->name('targets-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [TargetController::class, 'show'])->name('targets-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [TargetController::class, 'edit'])->name('targets-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [TargetController::class, 'update'])->name('targets-update'); // Created By Lujain Al-Smadi
            Route::get('destroy/{id}', [TargetController::class, 'destroy'])->name('targets-destroy'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [TargetController::class, 'softDelete'])->name('targets-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [TargetController::class, 'showSoftDelete'])->name('targets-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [TargetController::class, 'softDeleteRestore'])->name('targets-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [TargetController::class, 'activeInactiveSingle'])->name('targets-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        Route::group(['prefix' => 'premiumMemberships'], function () {
            Route::get('/create', [PremiumMembershipController::class, 'create'])->name('premiumMemberships-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [PremiumMembershipController::class, 'store'])->name('premiumMemberships-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [PremiumMembershipController::class, 'index'])->name('premiumMemberships-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [PremiumMembershipController::class, 'show'])->name('premiumMemberships-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [PremiumMembershipController::class, 'edit'])->name('premiumMemberships-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [PremiumMembershipController::class, 'update'])->name('premiumMemberships-update'); // Created By Lujain Al-Smadi

            Route::get('softDelete/{id}', [PremiumMembershipController::class, 'softDelete'])->name('premiumMemberships-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [PremiumMembershipController::class, 'showSoftDelete'])->name('premiumMemberships-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [PremiumMembershipController::class, 'softDeleteRestore'])->name('premiumMemberships-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [PremiumMembershipController::class, 'activeInactiveSingle'])->name('premiumMemberships-activeInactiveSingle'); // Created By Lujain Al-Smadi

            Route::get('/activeAll', [PremiumMembershipController::class, 'activeAll'])->name('premiumMemberships-activeAll'); // Created By Lujain Al-Smadi 
            Route::get('/inactiveAll', [PremiumMembershipController::class, 'inactiveAll'])->name('premiumMemberships-inactiveAll'); // Created By Lujain Al-Smadi 

        });

        // ==================================================================================================================
        // =========================================== PremiumMembershipPage Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'premium_membership_pages'], function () {
            Route::get('/index', [PremiumMembershipPageController::class, 'index'])->name('premium_membership_pages-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [PremiumMembershipPageController::class, 'edit'])->name('premium_membership_pages-edit'); // Created By Lujain Al-Smadi
            Route::post(
                'update/{id}',
                [PremiumMembershipPageController::class, 'update']
            )->name('premium_membership_pages-update'); // Created By Lujain Al-Smadi
        });
        // ==================================================================================================================
        // =========================================== PremiumMembershipPage Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'advertisement_edit_request'], function () {
            Route::get('/index', [AdvertisementEditRequestController::class, 'index'])->name('advertisement_edit_request-index'); // Created By Lujain Al-Smadi
            Route::get('accept/{id}', [AdvertisementEditRequestController::class, 'accept'])->name('advertisement_edit_request-accept'); // Created By Lujain Al-Smadi
            Route::get('reject/{id}', [AdvertisementEditRequestController::class, 'reject'])->name('advertisement_edit_request-reject'); // Created By Lujain Al-Smadi
        });
        // ==================================================================================================================
        // =========================================== categories Routes ===================================================
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/create', [MainCategoryController::class, 'create'])->name('categories-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [MainCategoryController::class, 'store'])->name('categories-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [MainCategoryController::class, 'index'])->name('categories-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [MainCategoryController::class, 'show'])->name('categories-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [MainCategoryController::class, 'edit'])->name('categories-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [MainCategoryController::class, 'update'])->name('categories-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [MainCategoryController::class, 'softDelete'])->name('categories-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [MainCategoryController::class, 'showSoftDelete'])->name('categories-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [MainCategoryController::class, 'softDeleteRestore'])->name('categories-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [MainCategoryController::class, 'activeInactiveSingle'])->name('categories-activeInactiveSingle'); // Created By Lujain Al-Smadi

        });
        Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/create', [SubCategoryController::class, 'create'])->name('sub_categories-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [SubCategoryController::class, 'store'])->name('sub_categories-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [SubCategoryController::class, 'index'])->name('sub_categories-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [SubCategoryController::class, 'show'])->name('sub_categories-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('sub_categories-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [SubCategoryController::class, 'update'])->name('sub_categories-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [SubCategoryController::class, 'softDelete'])->name('sub_categories-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [SubCategoryController::class, 'showSoftDelete'])->name('sub_categories-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [SubCategoryController::class, 'softDeleteRestore'])->name('sub_categories-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [SubCategoryController::class, 'activeInactiveSingle'])->name('sub_categories-activeInactiveSingle'); // Created By Lujain Al-Smadi

        });
        Route::group(['prefix' => 'features'], function () {
            Route::get('/create', [FeatureController::class, 'create'])->name('features-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [FeatureController::class, 'store'])->name('features-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [FeatureController::class, 'index'])->name('features-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [FeatureController::class, 'show'])->name('features-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [FeatureController::class, 'edit'])->name('features-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [FeatureController::class, 'update'])->name('features-update'); // Created By Lujain Al-Smadi

            Route::get('softDelete/{id}', [FeatureController::class, 'softDelete'])->name('features-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [FeatureController::class, 'showSoftDelete'])->name('features-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [FeatureController::class, 'softDeleteRestore'])->name('features-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [FeatureController::class, 'activeInactiveSingle'])->name('features-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        Route::group(['prefix' => 'feature_types'], function () {
            Route::get('/create', [FeatureTypeController::class, 'create'])->name('feature_types-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [FeatureTypeController::class, 'store'])->name('feature_types-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [FeatureTypeController::class, 'index'])->name('feature_types-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [FeatureTypeController::class, 'show'])->name('feature_types-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [FeatureTypeController::class, 'edit'])->name('feature_types-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [FeatureTypeController::class, 'update'])->name('feature_types-update'); // Created By Lujain Al-Smadi

            Route::get('softDelete/{id}', [FeatureTypeController::class, 'softDelete'])->name('feature_types-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [FeatureTypeController::class, 'showSoftDelete'])->name('feature_types-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [FeatureTypeController::class, 'softDeleteRestore'])->name('feature_types-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [FeatureTypeController::class, 'activeInactiveSingle'])->name('feature_types-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        Route::group(['prefix' => 'feature_type_sub_categories'], function () {
            Route::get('/create', [FeatureTypeSubcategoryController::class, 'create'])->name('feature_type_sub_categories-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [FeatureTypeSubcategoryController::class, 'store'])->name('feature_type_sub_categories-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [FeatureTypeSubcategoryController::class, 'index'])->name('feature_type_sub_categories-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [FeatureTypeSubcategoryController::class, 'show'])->name('feature_type_sub_categories-show'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [FeatureTypeSubcategoryController::class, 'edit'])->name('feature_type_sub_categories-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [FeatureTypeSubcategoryController::class, 'update'])->name('feature_type_sub_categories-update'); // Created By Lujain Al-Smadi
            Route::get('destroy/{id}', [FeatureTypeSubcategoryController::class, 'destroy'])->name('feature_type_sub_categories-destroy');

            Route::get('/activeInactiveSingle/{id}', [FeatureTypeSubcategoryController::class, 'activeInactiveSingle'])->name('feature_type_sub_categories-activeInactiveSingle'); // Created By Lujain Al-Smadi
            //Ajax Routes
            Route::post('/getSubCategories', [FeatureTypeSubcategoryController::class, 'getSubCategories'])->name('feature_type_sub_categories-getSubCategories'); // Created By Lujain Al-Smadi

        });

        //============================================================================================================
        //============================================ Diyarnaa Countries Routes By Lujain Al-Smadi ===================
        //============================================================================================================
        Route::group(['prefix' => 'diyarnaa_countries'], function () {
            Route::get('/create', [DiyarnaaCountryController::class, 'create'])->name('diyarnaa_countries-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [DiyarnaaCountryController::class, 'store'])->name('diyarnaa_countries-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [DiyarnaaCountryController::class, 'index'])->name('diyarnaa_countries-index'); // Created By Lujain Al-Smadi
            Route::get('showCities/{id}', [DiyarnaaCountryController::class, 'showCities'])->name('diyarnaa_countries-showCities'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [DiyarnaaCountryController::class, 'edit'])->name('diyarnaa_countries-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [DiyarnaaCountryController::class, 'update'])->name('diyarnaa_countries-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [DiyarnaaCountryController::class, 'softDelete'])->name('diyarnaa_countries-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [DiyarnaaCountryController::class, 'showSoftDelete'])->name('diyarnaa_countries-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [DiyarnaaCountryController::class, 'softDeleteRestore'])->name('diyarnaa_countries-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [DiyarnaaCountryController::class, 'activeInactiveSingle'])->name('diyarnaa_countries-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        //============================================================================================================
        //============================================ HomeSliders Routes By Lujain Al-Smadi ===================
        //============================================================================================================
        Route::group(['prefix' => 'home_sliders'], function () {
            Route::get('/create', [HomeSliderController::class, 'create'])->name('home_sliders-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [HomeSliderController::class, 'store'])->name('home_sliders-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [HomeSliderController::class, 'index'])->name('home_sliders-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [HomeSliderController::class, 'edit'])->name('home_sliders-edit'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [HomeSliderController::class, 'show'])->name('home_sliders-show'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [HomeSliderController::class, 'update'])->name('home_sliders-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [HomeSliderController::class, 'softDelete'])->name('home_sliders-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [HomeSliderController::class, 'showSoftDelete'])->name('home_sliders-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [HomeSliderController::class, 'softDeleteRestore'])->name('home_sliders-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [HomeSliderController::class, 'activeInactiveSingle'])->name('home_sliders-activeInactiveSingle'); // Created By Lujain Al-Smadi
            Route::get('reject/{id}', [HomeSliderController::class, 'reject'])->name('home_sliders-reject'); // Created By Lujain Al-Smadi
            Route::get('accept/{id}', [HomeSliderController::class, 'accept'])->name('home_sliders-accept'); // Created By Lujain Al-Smadi
            //Ajax Routes
            Route::post('/getDiyarnaaCities', [HomeSliderController::class, 'getDiyarnaaCities'])->name('home_sliders-getDiyarnaaCities'); // Created By Lujain Al-Smadi

        });
        //============================================ Diyarnaa Cities Routes By Lujain Al-Smadi ===================
        //============================================================================================================
        Route::group(['prefix' => 'diyarnaa_cities'], function () {
            Route::get('/create/{country_id}', [DiyarnaaCityController::class, 'create'])->name('diyarnaa_cities-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [DiyarnaaCityController::class, 'store'])->name('diyarnaa_cities-store'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [DiyarnaaCityController::class, 'edit'])->name('diyarnaa_cities-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [DiyarnaaCityController::class, 'update'])->name('diyarnaa_cities-update'); // Created By Lujain Al-Smadi
            Route::get('showRegions/{id}', [DiyarnaaCityController::class, 'showRegions'])->name('diyarnaa_cities-showRegions'); // Created By Lujain Al-Smadi

            Route::get('/activeInactiveSingle/{id}', [DiyarnaaCityController::class, 'activeInactiveSingle'])->name('diyarnaa_cities-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        //============================================ DiyarnaaRegions Routes By Lujain Al-Smadi ===================
        //============================================================================================================
        Route::group(['prefix' => 'diyarnaa_regions'], function () {
            Route::get('/create/{city_id}', [DiyarnaaRegionController::class, 'create'])->name('diyarnaa_regions-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [DiyarnaaRegionController::class, 'store'])->name('diyarnaa_regions-store'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [DiyarnaaRegionController::class, 'edit'])->name('diyarnaa_regions-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [DiyarnaaRegionController::class, 'update'])->name('diyarnaa_regions-update'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [DiyarnaaRegionController::class, 'activeInactiveSingle'])->name('diyarnaa_regions-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });
        //============================================================================================================
        //============================================ websiteBrokers Routes By Lujain Al-Smadi ===================
        Route::group(['prefix' => 'website_brokers'], function () {
            Route::get('/index', [WebsiteBrokerController::class, 'index'])->name('website_brokers-index'); // Created By Lujain Al-Smadi
            Route::get('/create', [WebsiteBrokerController::class, 'create'])->name('website_brokers-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [WebsiteBrokerController::class, 'store'])->name('website_brokers-store'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [WebsiteBrokerController::class, 'edit'])->name('website_brokers-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [WebsiteBrokerController::class, 'update'])->name('website_brokers-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [WebsiteBrokerController::class, 'softDelete'])->name('website_brokers-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [WebsiteBrokerController::class, 'showSoftDelete'])->name('website_brokers-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [WebsiteBrokerController::class, 'softDeleteRestore'])->name('website_brokers-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [WebsiteBrokerController::class, 'activeInactiveSingle'])->name('website_brokers-activeInactiveSingle'); // Created By Lujain Al-Smadi
            Route::get('reject/{id}', [WebsiteBrokerController::class, 'reject'])->name('website_brokers-reject'); // Created By Lujain Al-Smadi
            Route::get('accept/{id}', [WebsiteBrokerController::class, 'accept'])->name('website_brokers-accept'); // Created By Lujain Al-Smadi
        });

        //============================================ Advertisement Routes By Lujain Al-Smadi ===================
        //============================================================================================================
        Route::group(['prefix' => 'advertisements'], function () {
            Route::get('/create', [AdvertisementController::class, 'create'])->name('advertisements-create'); // Created By Lujain Al-Smadi
            Route::post('/store', [AdvertisementController::class, 'store'])->name('advertisements-store'); // Created By Lujain Al-Smadi
            Route::get('/index', [AdvertisementController::class, 'index'])->name('advertisements-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [AdvertisementController::class, 'edit'])->name('advertisements-edit'); // Created By Lujain Al-Smadi
            Route::get('acceptWithCondition/{id}', [AdvertisementController::class, 'acceptWithCondition'])->name('advertisements-acceptWithCondition'); // Created By Lujain Al-Smadi
            Route::post('acceptWithConditionRequest/{id}', [AdvertisementController::class, 'acceptWithConditionRequest'])->name('advertisements-acceptWithConditionRequest'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [AdvertisementController::class, 'show'])->name('advertisements-show'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [AdvertisementController::class, 'update'])->name('advertisements-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [AdvertisementController::class, 'softDelete'])->name('advertisements-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [AdvertisementController::class, 'showSoftDelete'])->name('advertisements-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [AdvertisementController::class, 'softDeleteRestore'])->name('advertisements-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [AdvertisementController::class, 'activeInactiveSingle'])->name('advertisements-activeInactiveSingle'); // Created By Lujain Al-Smadi
            Route::get('reject/{id}', [AdvertisementController::class, 'reject'])->name('advertisements-reject'); // Created By Lujain Al-Smadi
            Route::get('accept/{id}', [AdvertisementController::class, 'accept'])->name('advertisements-accept'); // Created By Lujain Al-Smadi
            Route::get('deleteImages/{id}', [AdvertisementController::class, 'deleteImages'])->name('advertisements-deleteImages'); // Created By Lujain Al-Smadi
            //Ajax Routes
            Route::post('/getUsers', [AdvertisementController::class, 'getUsers'])->name('advertisements-getUsers'); // Created By Lujain Al-Smadi
            Route::post('/getDiyarnaaCities', [AdvertisementController::class, 'getDiyarnaaCities'])->name('advertisements-getDiyarnaaCities'); // Created By Lujain Al-Smadi
            Route::post('/getDiyarnaaRegions', [AdvertisementController::class, 'getDiyarnaaRegions'])->name('advertisements-getDiyarnaaRegions'); // Created By Lujain Al-Smadi
            Route::post('/getSubCategories', [AdvertisementController::class, 'getSubCategories'])->name('advertisements-getSubCategories'); // Created By Lujain Al-Smadi
            Route::post('/getFeatureType', [AdvertisementController::class, 'getFeatureType'])->name('advertisements-getFeatureType'); // Created By Lujain Al-Smadi
            Route::post('/getFeature', [AdvertisementController::class, 'getFeature'])->name('advertisements-getFeature'); // Created By Lujain Al-Smadi

        });


        // =========================================== Internal mails Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'internal_mails'], function () {
            Route::get('/outgoing', [InternalMailsController::class, 'outgoing'])->name('internal_mails-outgoing'); // Created By: Lujain Al-Smadi
            Route::get('showOutgoing/{id}', [InternalMailsController::class, 'showOutgoing'])->name('internal_mails-showOutgoing'); // Created By: Lujain Al-Smadi
            Route::get('/inbox', [InternalMailsController::class, 'inbox'])->name('internal_mails-inbox'); // Created By: Lujain Al-Smadi
            Route::get('showInbox/{id}', [InternalMailsController::class, 'showInbox'])->name('internal_mails-showInbox'); // Created By: Lujain Al-Smadi
            Route::get('sendEmail', [InternalMailsController::class, 'sendEmail'])->name('internal_mails-sendEmail'); // Created By: Lujain Al-Smadi
            Route::post('sendEmailRequest/{id}', [InternalMailsController::class, 'sendEmailRequest'])->name('internal_mails-sendEmailRequest'); // Created By: Lujain Al-Smadi
            Route::get('destroy/{id}', [InternalMailsController::class, 'destroy'])->name('internal_mails-destroy'); // Created By Lujain Al-Smadi
        });
        // =========================================== About Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'job_requests'], function () {
            Route::get('/index', [JobRequestController::class, 'index'])->name('job_requests-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [JobRequestController::class, 'show'])->name('job_requests-show'); // Created By Lujain Al-Smadi
            Route::get('destroy/{id}', [JobRequestController::class, 'destroy'])->name('job_requests-destroy'); // Created By Lujain Al-Smadi
        });
        // =========================================== About Routes ===================================================
        Route::group(['prefix' => 'opinions'], function () {
            Route::get('/index', [OpinionController::class, 'index'])->name('opinions-index'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [OpinionController::class, 'show'])->name('opinions-show'); // Created By Lujain Al-Smadi
            Route::get('destroy/{id}', [OpinionController::class, 'destroy'])->name('opinions-destroy'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [OpinionController::class, 'activeInactiveSingle'])->name('opinions-activeInactiveSingle'); // Created By Lujain Al-Smadi
        });

        // =========================================== Payment Transaction Routes ===================================================
        Route::group(['prefix' => 'payment_transactions'], function () {
            Route::get('/index', [PaymentTransactionController::class, 'index'])->name('payment_transactions-index'); // Created By Lujain Al-Smadi
        });


        // ==================================================================================================================
        // =========================================== About Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'background_images'], function () {
            Route::get('/index', [BackgroundImageController::class, 'index'])->name('background_images-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [BackgroundImageController::class, 'edit'])->name('background_images-edit'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [BackgroundImageController::class, 'update'])->name('background_images-update'); // Created By Lujain Al-Smadi
        });
        //============================================ Advertisement Routes By Lujain Al-Smadi ===================
        //============================================================================================================
        Route::group(['prefix' => 'searches'], function () {
            Route::get('/index', [SearchController::class, 'index'])->name('searches-index'); // Created By Lujain Al-Smadi
            Route::get('edit/{id}', [SearchController::class, 'edit'])->name('searches-edit'); // Created By Lujain Al-Smadi
            Route::get('show/{id}', [SearchController::class, 'show'])->name('searches-show'); // Created By Lujain Al-Smadi
            Route::post('update/{id}', [SearchController::class, 'update'])->name('searches-update'); // Created By Lujain Al-Smadi
            Route::get('softDelete/{id}', [SearchController::class, 'softDelete'])->name('searches-softDelete'); // Created By Lujain Al-Smadi
            Route::get('/showSoftDelete', [SearchController::class, 'showSoftDelete'])->name('searches-showSoftDelete'); // Created By Lujain Al-Smadi
            Route::get('softDeleteRestore/{id}', [SearchController::class, 'softDeleteRestore'])->name('searches-softDeleteRestore'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSingle/{id}', [SearchController::class, 'activeInactiveSingle'])->name('searches-activeInactiveSingle'); // Created By Lujain Al-Smadi
            //Ajax Routes
            Route::post('/getFeatureType', [SearchController::class, 'getFeatureType'])->name('searches-getFeatureType'); // Created By Lujain Al-Smadi

        });


        // ==================================================================================================================
        // =========================================== User Routes ===================================================
        // ==================================================================================================================
        Route::group(['prefix' => 'employees'], function () {
            Route::get('/create', [EmployeeController::class, 'create'])->name('employees-create'); // Created By Qusai Al-Nablse
            Route::post('/store', [EmployeeController::class, 'store'])->name('employees-store'); // Created By Qusai Al-Nablse
            Route::get('/index', [EmployeeController::class, 'index'])->name('employees-index'); // Created By Qusai Al-Nablse
            Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('employees-edit'); // Created By Qusai Al-Nablse
            Route::post('update/{id}', [EmployeeController::class, 'update'])->name('employees-update'); // Created By Qusai Al-Nablse
            Route::get('softDelete/{id}', [EmployeeController::class, 'softDelete'])->name('employees-softDelete'); // Created By Qusai Al-Nablse
            Route::get('/showSoftDelete', [EmployeeController::class, 'showSoftDelete'])->name('employees-showSoftDelete'); // Created By Qusai Al-Nablse
            Route::get('softDeleteRestore/{id}', [EmployeeController::class, 'softDeleteRestore'])->name('employees-softDeleteRestore'); // Created By Qusai Al-Nablse            
        });
    });
});




Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', [FrontEndController::class, 'welcome'])->name('welcome');
    Route::get('EmailVerify/{verify_id}/{type}', [FrontEndController::class, 'EmailVerify'])->name('EmailVerify');
    Route::get('EmailVerifySubscribeNewsletter/{email}', [FrontEndController::class, 'EmailVerifySubscribeNewsletter'])->name('EmailVerifySubscribeNewsletter');
    Route::get('/aboutUs', [FrontEndController::class, 'aboutUs'])->name('aboutUs'); // Created By Lujain Al-Smadi
    Route::get('/ContactUs', [FrontEndController::class, 'ContactUs'])->name('contactUs'); // Created By Lujain Al-Smadi
    Route::post('/ContactUsRequest', [FrontEndController::class, 'ContactUsRequest'])->name('ContactUsRequest');
    Route::post('/userSignupRequest', [FrontEndController::class, 'userSignupRequest'])->name('userSignupRequest'); // Created By Lujain Al-Smadi
    Route::get('/userSignup', [FrontEndController::class, 'userSignup'])->name('userSignup'); // Created By Lujain Al-Smadi
    Route::get('/userLogin', [FrontEndController::class, 'userLogin'])->name('userLogin'); // Created By Lujain Al-Smadi
    Route::post('/userLoginRequest', [FrontEndController::class, 'userLoginRequest'])->name('userLoginRequest'); // Created By Lujain Al-Smadi
    Route::get('/userLogout', [FrontEndController::class, 'userLogout'])->name('userLogout'); // Created By Lujain Al-Smadi



    Route::get('/forgotPassword', [ResetPassword::class, 'forgotPassword'])->name('forgotPassword'); // Created By Lujain Al-Smadi
    Route::get('/validation/{token}', [ResetPassword::class, 'validation'])->name('validation'); // Created By Lujain Al-Smadi
    Route::post('validatePasswordRequest', [ResetPassword::class, 'validatePasswordRequest'])->name('validatePasswordRequest'); //Created by: Lujain Al-Smadi
    Route::post('resetNewPassword', [ResetPassword::class, 'resetNewPassword'])->name('resetNewPassword'); //Created by: Lujain Al-Smadi



    Route::get('/WebsiteBroker', [FrontEndController::class, 'WebsiteBroker'])->name('WebsiteBroker'); // Created By Lujain Al-Smadi
    Route::get('/WebsiteBrokerRequestForm', [FrontEndController::class, 'WebsiteBrokerRequestForm'])->name('WebsiteBrokerRequestForm'); // Created By Lujain Al-Smadi
    Route::post('/WebsiteBrokerRequest', [FrontEndController::class, 'WebsiteBrokerRequest'])->name('WebsiteBrokerRequest'); // Created By Lujain Al-Smadi
    Route::get('/advertisements', [FrontEndController::class, 'advertisements'])->name('advertisements'); // Created By Lujain Al-Smadi
    Route::get('/PremiumMembership', [FrontEndController::class, 'PremiumMembership'])->name('PremiumMembership'); // Created By Lujain Al-Smadi
    Route::get('/buyPremiumMembership/{premium_membership_id}', [FrontEndController::class, 'buyPremiumMembership'])->name('buyPremiumMembership'); // Created By Lujain Al-Smadi
    Route::get('/bookAdvertisement', [FrontEndController::class, 'bookAdvertisement'])->name('bookAdvertisement'); // Created By Lujain Al-Smadi
    Route::post('/bookAdvertisementRequest', [FrontEndController::class, 'bookAdvertisementRequest'])->name('bookAdvertisementRequest'); // Created By Lujain Al-Smadi
    Route::get('/aboutCompany', [FrontEndController::class, 'aboutCompany'])->name('aboutCompany');
    Route::get('/termsAndConditions', [FrontEndController::class, 'termsAndConditions'])->name('termsAndConditions');
    Route::get('/privacyAndPolicy', [FrontEndController::class, 'privacyAndPolicy'])->name('privacyAndPolicy');
    Route::post('/sendEnquiry/{id}', [FrontEndController::class, 'sendEnquiry'])->name('sendEnquiry'); // Created By Lujain Al-Smadi
    Route::get('/advertisementDetails/{id}',  [FrontEndController::class, 'advertisementDetails'])->name('advertisementDetails'); // Created By Lujain Al-Smadi
    Route::get('/jobs', [FrontEndController::class, 'jobs'])->name('jobs');
    Route::get('/jobDetails/{id}', [FrontEndController::class, 'jobDetails'])->name('jobDetails');
    Route::post('/jobRequest/{id}',  [FrontEndController::class, 'jobRequest'])->name('jobRequest'); // Created By Lujain Al-Smadi
    Route::post('/newsletterSubscribe', [FrontEndController::class, 'newsletterSubscribe'])->name('newsletterSubscribe'); // Created By Lujain Al-Smadi
    //ajax routes
    Route::post('/getSubCategories', [FrontEndController::class, 'getSubCategories'])->name('getSubCategories'); // Created By Lujain Al-Smadi
    Route::post('/getDiyarnaaCities', [FrontEndController::class, 'getDiyarnaaCities'])->name('getDiyarnaaCities'); // Created By Lujain Al-Smadi
    Route::post('/getDiyarnaaRegions', [FrontEndController::class, 'getDiyarnaaRegions'])->name('getDiyarnaaRegions'); // Created By Lujain Al-Smadi
    // Front End Auth 
    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('/complaints', [FrontEndController::class, 'complaints'])->name('complaints');
        Route::post('/sendComplaints', [FrontEndController::class, 'sendComplaints'])->name('sendComplaints');
        Route::get('/paymentTransactions', [FrontEndController::class, 'paymentTransactions'])->name('paymentTransactions');
        Route::get('/addRemoveFavAds/{id}', [FrontEndController::class, 'addRemoveFavAds'])->name('addRemoveFavAds');
        Route::get('/internalMail', [FrontEndController::class, 'internalMail'])->name('internalMail');
        Route::get('/messageDetails/{id}', [FrontEndController::class, 'messageDetails'])->name('messageDetails');
        Route::post('/sendEmail', [FrontEndController::class, 'sendEmail'])->name('sendEmail');
        Route::get('/replyMessage/{id}', [FrontEndController::class, 'replyMessage'])->name('replyMessage');
        Route::get('/forword/{id}', [FrontEndController::class, 'forword'])->name('forword');
        Route::get('/delete/{id}', [FrontEndController::class, 'delete'])->name('delete');
        Route::get('/opinionForm', [FrontEndController::class, 'opinionForm'])->name('opinionForm');
        Route::post('/storeOpinion', [FrontEndController::class, 'storeOpinion'])->name('storeOpinion');
        //================================================================================
        //============================  Real Estate Office Routes =======================
        //================================================================================
        Route::group(['prefix' => 'office', 'middleware' => 'check_real_estate_office'], function () {
            Route::get('/userDashboard', [RealEstateOfficeController::class, 'userDashboard'])->name('office-userDashboard'); // Created By Lujain Al-Smadi
            Route::get('/myAdvertisements', [RealEstateOfficeController::class, 'myAdvertisements'])->name('office-myAdvertisements'); // Created By Lujain Al-Smadi
            Route::get('/addAdvertisements', [RealEstateOfficeController::class, 'addAdvertisements'])->name('office-addAdvertisements'); // Created By Lujain Al-Smadi
            Route::post('/addAdvertisementsRequest', [RealEstateOfficeController::class, 'addAdvertisementsRequest'])->name('office-addAdvertisementsRequest'); // Created By Lujain Al-Smadi
            Route::get('/editAdvertisement/{id}', [RealEstateOfficeController::class, 'editAdvertisement'])->name('office-editAdvertisement'); // Created By Lujain Al-Smadi
            Route::post('/updateAdvertisementRequest/{id}', [RealEstateOfficeController::class, 'updateAdvertisementRequest'])->name('office-updateAdvertisementRequest'); // Created By Lujain Al-Smadi
            Route::post('/getFeatureType', [RealEstateOfficeController::class, 'getFeatureType'])->name('office-getFeatureType'); // Created By Lujain Al-Smadi
            Route::get('/myAdvertisementDetails/{id}', [RealEstateOfficeController::class, 'myAdvertisementDetails'])->name('office-myAdvertisementDetails'); // Created By Lujain Al-Smadi
            Route::get('/myPremiumMembership', [RealEstateOfficeController::class, 'myPremiumMembership'])->name('office-myPremiumMembership'); // Created By Lujain Al-Smadi
            Route::get('/editUserDashboard/{id}', [RealEstateOfficeController::class, 'editUserDashboard'])->name('office-editUserDashboard'); // Created By Lujain Al-Smadi
            Route::post('/updateUserDashboard/{id}', [RealEstateOfficeController::class, 'updateUserDashboard'])->name('office-updateUserDashboard'); // Created By Lujain Al-Smadi
            Route::get('/advertisementEditRequest/{id}', [RealEstateOfficeController::class, 'advertisementEditRequest'])->name('office-advertisementEditRequest');
            Route::get('deleteAdvertisement/{id}', [RealEstateOfficeController::class, 'deleteAdvertisement'])->name('office-deleteAdvertisement'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveAdvertisement/{id}', [RealEstateOfficeController::class, 'activeInactiveAdvertisement'])->name('office-activeInactiveAdvertisement'); // Created By Lujain Al-Smadi
            Route::get('/viewEnquiry', [RealEstateOfficeController::class, 'viewEnquiry'])->name('office-viewEnquiry'); // Created By Lujain Al-Smadi
            Route::get('/enquiryDetails/{id}', [RealEstateOfficeController::class, 'enquiryDetails'])->name('office-enquiryDetails'); // Created By Lujain Al-Smadi
            Route::get('destroyEnquiry/{id}', [RealEstateOfficeController::class, 'destroyEnquiry'])->name('office-destroyEnquiry'); // Created By Lujain Al-Smadi
            Route::post('/sendEnquiryReplay/{id}', [RealEstateOfficeController::class, 'sendEnquiryReplay'])->name('office-sendEnquiryReplay'); // Created By Lujain Al-Smadi
            Route::get('/customerRequestsOffers', [RealEstateOfficeController::class, 'customerRequestsOffers'])->name('office-customerRequestsOffers'); // Created By Lujain Al-Smadi
            Route::get('/createCustomerRequestsOffer', [RealEstateOfficeController::class, 'createCustomerRequestsOffer'])->name('office-createCustomerRequestsOffer'); // Created By Lujain Al-Smadi
            Route::get('/showCustomerRequestsOffer/{id}', [RealEstateOfficeController::class, 'showCustomerRequestsOffer'])->name('office-showCustomerRequestsOffer'); // Created By Lujain Al-Smadi
            Route::post('/storeCustomerRequestsOffer', [RealEstateOfficeController::class, 'storeCustomerRequestsOffer'])->name('office-storeCustomerRequestsOffer'); // Created By Lujain Al-Smadi
            Route::get('destroyCustomerRequestOffer/{id}', [RealEstateOfficeController::class, 'destroyCustomerRequestOffer'])->name('office-destroyCustomerRequestOffer'); // Created By Lujain Al-Smadi
            Route::get('changeRealEstateOfficeLoginInfo', [RealEstateOfficeController::class, 'changeRealEstateOfficeLoginInfo'])->name('office-changeRealEstateOfficeLoginInfo'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficePassword', [RealEstateOfficeController::class, 'changeRealEstateOfficePassword'])->name('office-changeRealEstateOfficePassword'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficeEmail', [RealEstateOfficeController::class, 'changeRealEstateOfficeEmail'])->name('office-changeRealEstateOfficeEmail'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficePhone', [RealEstateOfficeController::class, 'changeRealEstateOfficePhone'])->name('office-changeRealEstateOfficePhone'); // Created By Lujain Al-Smadi
            Route::get('/myFavAds', [RealEstateOfficeController::class, 'myFavAds'])->name('office-myFavAds');
        });
        //================================================================================
        //============================  Real Estate Owner Routes =======================
        //================================================================================
        Route::group(['prefix' => 'owner', 'middleware' => 'check_real_estate_owner'], function () {
            Route::get('/userDashboard', [RealEstateOwnerController::class, 'userDashboard'])->name('owner-userDashboard'); // Created By Lujain Al-Smadi
            Route::get('/myAdvertisements', [RealEstateOwnerController::class, 'myAdvertisements'])->name('owner-myAdvertisements'); // Created By Lujain Al-Smadi
            Route::get('/addAdvertisements', [RealEstateOwnerController::class, 'addAdvertisements'])->name('owner-addAdvertisements'); // Created By Lujain Al-Smadi
            Route::post('/addAdvertisementsRequest', [RealEstateOwnerController::class, 'addAdvertisementsRequest'])->name('owner-addAdvertisementsRequest'); // Created By Lujain Al-Smadi
            Route::get('/editAdvertisement/{id}', [RealEstateOwnerController::class, 'editAdvertisement'])->name('owner-editAdvertisement'); // Created By Lujain Al-Smadi
            Route::post('/updateAdvertisementRequest/{id}', [RealEstateOwnerController::class, 'updateAdvertisementRequest'])->name('owner-updateAdvertisementRequest'); // Created By Lujain Al-Smadi
            Route::post('/getFeatureType', [RealEstateOwnerController::class, 'getFeatureType'])->name('owner-getFeatureType'); // Created By Lujain Al-Smadi
            Route::get('/myAdvertisementDetails/{id}', [RealEstateOwnerController::class, 'myAdvertisementDetails'])->name('owner-myAdvertisementDetails'); // Created By Lujain Al-Smadi
            Route::get('/myPremiumMembership', [RealEstateOwnerController::class, 'myPremiumMembership'])->name('owner-myPremiumMembership'); // Created By Lujain Al-Smadi
            Route::get('/editUserDashboard/{id}', [RealEstateOwnerController::class, 'editUserDashboard'])->name('owner-editUserDashboard'); // Created By Lujain Al-Smadi
            Route::post('/updateUserDashboard/{id}', [RealEstateOwnerController::class, 'updateUserDashboard'])->name('owner-updateUserDashboard'); // Created By Lujain Al-Smadi
            Route::get('/advertisementEditRequest/{id}', [RealEstateOwnerController::class, 'advertisementEditRequest'])->name('owner-advertisementEditRequest');
            Route::get('deleteAdvertisement/{id}', [RealEstateOwnerController::class, 'deleteAdvertisement'])->name('owner-deleteAdvertisement'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveAdvertisement/{id}', [RealEstateOwnerController::class, 'activeInactiveAdvertisement'])->name('owner-activeInactiveAdvertisement'); // Created By Lujain Al-Smadi
            Route::get('/viewEnquiry', [RealEstateOwnerController::class, 'viewEnquiry'])->name('owner-viewEnquiry'); // Created By Lujain Al-Smadi
            Route::get('/enquiryDetails/{id}', [RealEstateOwnerController::class, 'enquiryDetails'])->name('owner-enquiryDetails'); // Created By Lujain Al-Smadi
            Route::get('destroyEnquiry/{id}', [RealEstateOwnerController::class, 'destroyEnquiry'])->name('owner-destroyEnquiry'); // Created By Lujain Al-Smadi
            Route::post('/sendEnquiryReplay/{id}', [RealEstateOwnerController::class, 'sendEnquiryReplay'])->name('owner-sendEnquiryReplay'); // Created By Lujain Al-Smadi
            Route::get('/customerRequestsOffers', [RealEstateOwnerController::class, 'customerRequestsOffers'])->name('owner-customerRequestsOffers'); // Created By Lujain Al-Smadi
            Route::get('/createCustomerRequestsOffer', [RealEstateOwnerController::class, 'createCustomerRequestsOffer'])->name('owner-createCustomerRequestsOffer'); // Created By Lujain Al-Smadi
            Route::get('/showCustomerRequestsOffer/{id}', [RealEstateOwnerController::class, 'showCustomerRequestsOffer'])->name('owner-showCustomerRequestsOffer'); // Created By Lujain Al-Smadi
            Route::post('/storeCustomerRequestsOffer', [RealEstateOwnerController::class, 'storeCustomerRequestsOffer'])->name('owner-storeCustomerRequestsOffer'); // Created By Lujain Al-Smadi
            Route::get('destroyCustomerRequestOffer/{id}', [RealEstateOwnerController::class, 'destroyCustomerRequestOffer'])->name('owner-destroyCustomerRequestOffer'); // Created By Lujain Al-Smadi
            Route::get('changeRealEstateOfficeLoginInfo', [RealEstateOwnerController::class, 'changeRealEstateOfficeLoginInfo'])->name('owner-changeRealEstateOfficeLoginInfo'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficePassword', [RealEstateOwnerController::class, 'changeRealEstateOfficePassword'])->name('owner-changeRealEstateOfficePassword'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficeEmail', [RealEstateOwnerController::class, 'changeRealEstateOfficeEmail'])->name('owner-changeRealEstateOfficeEmail'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficePhone', [RealEstateOwnerController::class, 'changeRealEstateOfficePhone'])->name('owner-changeRealEstateOfficePhone'); // Created By Lujain Al-Smadi
            Route::get('/myFavAds', [RealEstateOwnerController::class, 'myFavAds'])->name('owner-myFavAds');
        });
        //================================================================================
        //============================  Real Estate Seeker Routes =======================
        //================================================================================
        Route::group(['prefix' => 'seeker', 'middleware' => 'check_real_estate_seeker'], function () {
            Route::get('/userDashboard', [RealEstateSeekerController::class, 'userDashboard'])->name('seeker-userDashboard'); // Created By Lujain Al-Smadi
            Route::post('/getFeatureType', [RealEstateSeekerController::class, 'getFeatureType'])->name('seeker-getFeatureType'); // Created By Lujain Al-Smadi
            Route::get('/myPremiumMembership', [RealEstateSeekerController::class, 'myPremiumMembership'])->name('seeker-myPremiumMembership'); // Created By Lujain Al-Smadi
            Route::get('/editUserDashboard/{id}', [RealEstateSeekerController::class, 'editUserDashboard'])->name('seeker-editUserDashboard'); // Created By Lujain Al-Smadi
            Route::post('/updateUserDashboard/{id}', [RealEstateSeekerController::class, 'updateUserDashboard'])->name('seeker-updateUserDashboard'); // Created By Lujain Al-Smadi
            Route::get('changeRealEstateOfficeLoginInfo', [RealEstateSeekerController::class, 'changeRealEstateOfficeLoginInfo'])->name('seeker-changeRealEstateOfficeLoginInfo'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficePassword', [RealEstateSeekerController::class, 'changeRealEstateOfficePassword'])->name('seeker-changeRealEstateOfficePassword'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficeEmail', [RealEstateSeekerController::class, 'changeRealEstateOfficeEmail'])->name('seeker-changeRealEstateOfficeEmail'); // Created By Lujain Al-Smadi
            Route::post('changeRealEstateOfficePhone', [RealEstateSeekerController::class, 'changeRealEstateOfficePhone'])->name('seeker-changeRealEstateOfficePhone'); // Created By Lujain Al-Smadi
            Route::get('/addSearch', [RealEstateSeekerController::class, 'addSearch'])->name('seeker-addSearch'); // Created By Lujain Al-Smadi
            Route::post('/addSearchRequest', [RealEstateSeekerController::class, 'addSearchRequest'])->name('seeker-addSearchRequest'); // Created By Lujain Al-Smadi
            Route::get('/MyResearch', [RealEstateSeekerController::class, 'MyResearch'])->name('seeker-MyResearch'); // Created By Lujain Al-Smadi
            Route::get('/activeInactiveSearch/{id}', [RealEstateSeekerController::class, 'activeInactiveSearch'])->name('seeker-activeInactiveSearch'); // Created By Lujain Al-Smadi
            Route::get('deleteSearch/{id}', [RealEstateSeekerController::class, 'deleteSearch'])->name('seeker-deleteSearch'); // Created By Lujain Al-Smadi
            Route::get('/editSearch/{id}', [RealEstateSeekerController::class, 'editSearch'])->name('seeker-editSearch'); // Created By Lujain Al-Smadi
            Route::post('/updateSearchRequest/{id}', [RealEstateSeekerController::class, 'updateSearchRequest'])->name('seeker-updateSearchRequest'); // Created By Lujain Al-Smadi
            Route::get('/mySearchDetails/{id}', [RealEstateSeekerController::class, 'mySearchDetails'])->name('seeker-mySearchDetails'); // Created By Lujain Al-Smadi
            Route::get('/myFavAds', [RealEstateSeekerController::class, 'myFavAds'])->name('seeker-myFavAds');
        });
    });
});
