<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminController;

use App\Http\Controllers\admin\HomeController;

use App\Http\Controllers\admin\CmsController;

use App\Http\Controllers\admin\FaqController;

use App\Http\Controllers\admin\BusinessController;

use App\Http\Controllers\admin\EventController;

use App\Http\Controllers\admin\ColorController;

use App\Http\Controllers\admin\BusinessClubTypeController;



use App\Http\Controllers\AuthController;

use App\Http\Controllers\web\FrontController;

use App\Http\Controllers\web\UserController;

use App\Http\Controllers\web\DashboardController;

use App\Http\Controllers\web\AllSecationController;

use App\Http\Controllers\web\ClubController;

use App\Http\Controllers\web\EventsController;

use App\Http\Controllers\web\FacilityController;

use App\Http\Controllers\web\MembershipController;

use App\Http\Controllers\web\CompanyPortalController;

use App\Http\Controllers\web\BankAccountController;

use App\Http\Controllers\web\PaymentController;

use App\Http\Controllers\web\BankController;



use App\Http\Controllers\CsvController;



//use Redirect;





/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "web" middleware group. Make something great!

|

*/



//Frontend Route



// Route::domain('{username}.'.env('BASE_DOMAIN'))->group(function () {

//     // determine the subdomain of the current request

//     $server        = explode('.', $_SERVER["HTTP_HOST"]);

//     $sansSubdomain = implode('.', array_slice($server, 1));



//     $isValidSubdomain = 0;

//     // there are 3 parts to the domain (i.e.  user.domain.com)

//     if (count($server) >= 3) {

//         // first part of array is the subdomain, duh

//         $subdomain = $server[0];



//         // check if it's "www" (or similar / mistyped variant)

//         if(in_array($subdomain, array('w', 'ww', 'www', 'wwww'))) {

//             // route somewhere or set a config variable

//             // or do nothing because the next condition is where the magic happens

//             if (count($server) > 3) {

//                 $subdomainTwo = $server[1];

//                 $predefinedResults = \App\Models\User::where('slug', $subdomainTwo)->value('slug');



//                 // if there's a valid matching predefined result

//                 if(!$predefinedResults)

//                 {

//                     Session::flash('error', $subdomainTwo.' is not a valid business.');

//                     return Redirect::to('http://'.env('BASE_DOMAIN'));

//                 }else{

//                     $isValidSubdomain = 1;

//                 }

//             }



//         }



//         // possibly a meaningful subdomain but we're not sure yet

//         else if(!is_null($subdomain))

//         {

//             // match against your predefined list here

//             $predefinedResults = \App\Models\User::where('slug', $subdomain)->value('slug');



//             // if there's a valid matching predefined result

//             if(!$predefinedResults)

//             {

//                 Session::flash('error', $subdomain.' is not a valid business.');

//                 return Redirect::to('http://'.env('BASE_DOMAIN'));

//             }else{

//                 $isValidSubdomain = 1;

//             }



//             // if this code gets executed, the subdomain is kosher

//             // do other data-juggling here if needed



//         }



//         // subdomain is invalid or just catch-all depending on your preceding logic

//         else

//         {

//             // present error or handle appropriately for your needs

//         }

//     }



// 	if($isValidSubdomain) {

// 		 // Domain does not start with 'www.'

// 		 Route::middleware(['check_bank'])->group(function () {

// 			//CompanyPortal

// 			Route::get('/',  [CompanyPortalController::class, 'CompanyPriview'])->name('shop_portal');





// 			//Product

// 			Route::get('/product/all',  [CompanyPortalController::class, 'ShopPortallist'])->name('shop_portal_all');

// 			Route::get('/product/details/{product}',  [CompanyPortalController::class, 'ShopPortalDetails'])->name('shop_portal_details');

// 			Route::post('/product/size/variation',  [CompanyPortalController::class, 'ShopPortalColorVariation'])->name('set_variation_color');

// 			Route::post('/product/price/variation',  [CompanyPortalController::class, 'ShopPortalPriceVariation'])->name('set_variation_price');





// 			//Product

// 			//Event Details

// 			Route::get('/event/all',  [CompanyPortalController::class, 'Eventlist'])->name('event_all');

// 			Route::get('/event/details/{event}',  [CompanyPortalController::class, 'EventDetails'])->name('event_details');

// 			//facility Details

// 			Route::get('/facility/all',  [CompanyPortalController::class, 'Facilitylist'])->name('facility_all');

// 			Route::get('/facility/details/{facility}',  [CompanyPortalController::class, 'FacilitytDetails'])->name('facility_details');

// 			//Membership Details

// 			Route::get('/membership/all',  [CompanyPortalController::class, 'Membershiplist'])->name('membership_all');

// 			Route::get('/membership/details/{membership}',  [CompanyPortalController::class, 'MembershipDetails'])->name('membership_details');

// 			//Membership Details

// 			Route::get('/contact-us',  [CompanyPortalController::class, 'ContactUs'])->name('portal_contact_us');



// 			//Cart Details

// 			Route::get('/cart-list',  [CompanyPortalController::class, 'CartList'])->name('cart_list');

// 			Route::get('/checkout-page',  [CompanyPortalController::class, 'CheckOut'])->name('checkout_out');

// 			Route::post('/add-to-cart',  [CompanyPortalController::class, 'AddToCart'])->name('add_tocart');

// 			Route::post('/update-cart',  [CompanyPortalController::class, 'UpdateCart'])->name('cart_update');

// 			Route::post('/event-update-cart',  [CompanyPortalController::class, 'UpdateEventTicketCart'])->name('event_cart_update');

// 			Route::post('/remove-cart',  [CompanyPortalController::class, 'RemoveCart'])->name('cart_remove');

// 			Route::post('/remove-event-cart',  [CompanyPortalController::class, 'RemoveEventCart'])->name('cart_event_remove');

// 			Route::post('/event-details-quintity-update',  [CompanyPortalController::class, 'UpdateEventDetailsTicket'])->name('event_details_queintity_update');



// 			//Cart Details



// 			Route::get('/page/{page?}', [CompanyPortalController::class, 'TermCondition'])->name('portal_cms_all_pages');

// 			Route::get('/about-us',  [CompanyPortalController::class, 'AboutUs'])->name('portal_about_us');

// 			Route::any('/{type?}/{productId?}/book-now',  [CompanyPortalController::class, 'BookNow'])->name('book_now');

// 			Route::get('/{type?}/{productId?}/{id?}/book-now',  [CompanyPortalController::class, 'BookNow'])->name('book_now_event');

// 			Route::name('payment.')->prefix('payment')->group(function () {

// 				Route::any("/{id}/{type?}", [PaymentController::class, 'create'])->name('payment');

// 				Route::post("/", [PaymentController::class, 'store'])->name('payment_store');

// 			});
// 			Route::get("/thank-you", [PaymentController::class, 'ThankYou'])->name('thank_you');

// 			Route::post("/product", [PaymentController::class, 'ProductPayment'])->name('product_payment');

// 		});



// 	}



// 	//  Route::get('/',  [CompanyPortalController::class, 'CompanyPriview'])->name('business.home');



// });





Route::get('/',  [FrontController::class, 'index'])->name('website-home');







Route::get('/login',  [UserController::class, 'UserLogin'])->name('login_business');



Route::post('/loginBusiness',  [UserController::class, 'AuthLogin'])->name('businessLogin');



Route::get('/register-business',  [UserController::class, 'Register'])->name('business_register');



Route::get('forget-password', [UserController::class, 'ForgetPassword'])->name('forget_password');



Route::post('forgot-password-post', [UserController::class, 'forgotPasswordSubmit'])->name('forgot.password.post');

Route::get('forgot-password/verify', [UserController::class, 'verifyForgotPassword'])->name('verify.forgot-password.get');

Route::post('forgot-password/verify', [UserController::class, 'verifyForgotPasswordSubmit'])->name('verify.forgot-password.post');

Route::any('sendotp', [UserController::class, 'sendOtp'])->name('sendotp');



Route::get('reset-password', [UserController::class, 'resetPassword'])->name('reset.password.gets');

Route::post('reset-password-post', [UserController::class, 'resetPasswordSubmit'])->name('reset.password.post');

Route::get('page/{slug}', [FrontController::class, 'TermCondition'])->name('cms_all_pages');





Route::get('/forgot-password',  [UserController::class, 'Fo'])->name('business_register');

Route::post('/register-store',  [UserController::class, 'RegisterStore'])->name('store_register');

Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify');

Route::post('/inquiry/store',  [FrontController::class, 'landingInquiryStore'])->name('inquiry.store');

Route::get('/about-us',  [FrontController::class, 'AboutUs'])->name('about_us');

Route::get('/how-it',  [FrontController::class, 'HowItWork'])->name('how_it_work');

Route::get('/business/contact-us',  [FrontController::class, 'ContactUs'])->name('contact_us');

Route::post('/business/contact-us/store',  [FrontController::class, 'ContactUsStore'])->name('contact_us_store');

Route::get('/generate-csv/{type}', [CsvController::class, 'generateCsv'])->name('active_csv');

Route::get('/generate-ticket-csv', [CsvController::class, 'generateTicketCsv'])->name('ticket_csv');

Route::get('/generate-product-csv', [CsvController::class, 'generateProductCsv'])->name('product_csv');

Route::get('/generate-facility-csv', [CsvController::class, 'generateFacilityCsv'])->name('facility_csv');

Route::get('/generate-transaction-csv', [CsvController::class, 'generateTransactionCsv'])->name('transaction_csv');



//Cron MemberShip

Route::get('/membership-renew',  [PaymentController::class, 'MembershipRenew'])->name('membership_renew');



//Middleware route//

 Route::middleware(['user'])->group(function () {



	Route::post('user-logout', [UserController::class,'logoutUser'])->name('user.logout');

	Route::post('account-remove', [UserController::class,'RemoveAccount'])->name('account_remove');



    Route::get('/business/plan-subscription',  [FrontController::class, 'PlanSubscription'])->name('plan_subscription');

    Route::get('/business/purchase-plan',  [UserController::class, 'PurchasePlan'])->name('purchase_plan');



	// Route::middleware(['check_subscription'])->group(function () {

		Route::get('/business/dashboard/{data?}',  [FrontController::class, 'BusinessDashboard'])->name('b_dashboard');

		Route::get('/business/transaction-history',  [FrontController::class, 'TransactionHistory'])->name('transaction_history');





		Route::get('/business/profile',  [UserController::class, 'Profile'])->name('business_profile');

		Route::get('/business/edit-profile',  [UserController::class, 'EditProfile'])->name('business_edit_profile');

		Route::post('/business/updated',  [UserController::class, 'BusinessUpdate'])->name('business_update');

		Route::get('business/change-password',  [DashboardController::class, 'ChangePassword'])->name('business_change_password');

	    Route::post('business/update-password', [DashboardController::class, 'updatePassword'])->name('business_update_password');



		//Notification



	    Route::post('business/single-notification', [FrontController::class, 'notificationRead'])->name('single_notification');

	    Route::get('business/all-notification', [FrontController::class, 'allnotificationRead'])->name('all_notification');





		//Notification



		//Mailchimp Start



	    Route::get('business/mailchimp', [FrontController::class, 'MailchimpEdit'])->name('mailchimp');

	    Route::post('business/mailchimp-update', [FrontController::class, 'MailchimpUpdate'])->name('mailchimp_update');





		//Mailchimp End



		//Strart MembershipController Route

		Route::get('/business/member-ship/list',  [MembershipController::class, 'MemberShipPlan'])->name('member_ship');

		Route::get('/business/member-ship/member-list',  [MembershipController::class, 'MemberShipMemberList'])->name('member_list');

		Route::get('/business/member-ship/member-details/{id?}',  [MembershipController::class, 'MemberShipMemberDetails'])->name('member_details');

		Route::get('/business/member-ship/plan/add',  [MembershipController::class, 'AddPlane'])->name('add_plan');

		Route::post('/business/member-ship/plan/store',  [MembershipController::class, 'PlanStore'])->name('plan_store');

		Route::get('/business/member-ship/plan/edit/{id}',  [MembershipController::class, 'PlanEdit'])->name('edit_plane');

		Route::post('/business/member-ship/plan/update/{id}',  [MembershipController::class, 'PlanUpdate'])->name('plan_update');

		Route::post('/business/member-ship/plan/remove',  [MembershipController::class, 'PlanRemove'])->name('plan_remove');

		Route::get('/business/member-ship/plan/search',  [MembershipController::class, 'PlanSearch'])->name('event_serach');



		Route::post('/business/member-ship/terminate-membership',  [MembershipController::class, 'TerminateMembershhip'])->name('terminate_membership');



		//End MembershipController Route



		//Strart Event Route

		Route::get('/business/event/list',  [EventsController::class, 'EventList'])->name('event_list');

		Route::get('/business/event/add',  [EventsController::class, 'EventAdd'])->name('event_add');

		Route::post('/business/event/store',  [EventsController::class, 'EventStore'])->name('event_store');

		Route::get('/business/event/edit/{slug}',  [EventsController::class, 'EventEdit'])->name('event_edit');

		Route::post('/business/event/update/{id}',  [EventsController::class, 'EventUpdate'])->name('event_update');

		Route::post('/business/event/remove',  [EventsController::class, 'EventRemove'])->name('event_remove');

		Route::get('/business/event/history',  [EventsController::class, 'EventTicketList'])->name('event_history');



		Route::get('/business/event/ticket-user/{id}', [EventsController::class, 'EventTicketList'])->name('event_ticket_list');

		Route::post('event-category/business-cat-add', [EventsController::class,'BusinessCatAdd'])->name('add_business_cat');

		Route::get('/business/event/history-details/{id}', [EventsController::class, 'EventHistoryDetails'])->name('event_history_details');

		Route::post('/business/event/ticket/remove',  [EventsController::class, 'EventTicketRemove'])->name('event_ticket_remove');



		//End Event Route



		//Strart Product Route

		Route::get('/business/product/add',  [ClubController::class, 'ClubAdd'])->name('product_add');

		Route::post('/business/product/store',  [ClubController::class, 'ClubStore'])->name('product_store');

		Route::get('/business/product/list',  [ClubController::class, 'ClubList'])->name('product_list');

		Route::get('/business/product/edit/{slug}',  [ClubController::class, 'ClubEdit'])->name('product_edit');

		Route::post('/business/product/update/{slug}',  [ClubController::class, 'ClubUpdate'])->name('product_update');

		Route::post('/business/product/remove',  [ClubController::class, 'ClubRemove'])->name('product_remove');

		Route::get('/business/product/history',  [ClubController::class, 'ClubHistory'])->name('product_history');

		Route::get('/business/product/history-details/{id}',  [ClubController::class, 'ClubHistoryDetails'])->name('product_history_details');

		Route::get('/business/product/variation/edit/{slug}',  [ClubController::class, 'ClubVariationEdit'])->name('product_variation_edit');

		Route::post('/business/product/variation/update/{slug}',  [ClubController::class, 'ClubVariationUpdate'])->name('product_variation_update');

		Route::post('/business/product/variation/remove',  [ClubController::class, 'ClubVariationRemove'])->name('remove_variation');





		//End Product Route



		//Start facility Route

		Route::get('/business/facility/all',  [FacilityController::class, 'AllFacility'])->name('all_facility');

		Route::get('/business/facility/add',  [FacilityController::class, 'AddFacility'])->name('add_facility');

		Route::post('/business/facility/store',  [FacilityController::class, 'FacilityStore'])->name('facility_store');

		Route::get('/business/facility/edit/{slug}',  [FacilityController::class, 'FacilityEdit'])->name('facility_edit');

		Route::post('/business/facility/update/{slug}',  [FacilityController::class, 'FacilityUpdate'])->name('facility_update');

		Route::post('/business/facility/remove',  [FacilityController::class, 'facilityRemove'])->name('facility_remove');

		Route::get('/business/facility/history',  [FacilityController::class, 'FacilityHistory'])->name('facility_history');

		Route::get('/business/facility/history-details/{id}',  [FacilityController::class, 'FacilityHistoryDetails'])->name('facility_order_details');



		//End facility Route



		//Start Add Rimender Route

		Route::post('/business/facility/add-reminder',  [DashboardController::class, 'AddReminder'])->name('add_reminder');

		Route::get('/business/facility/get-reminder',  [DashboardController::class, 'GetReminder'])->name('get_reminder_data');

		Route::post('/business/facility/update-reminder',  [DashboardController::class, 'UpdateReminder'])->name('update_reminder');

		//End Add Rimender Route





		Route::get('/business/secation/home-section',  [AllSecationController::class, 'HomeSecation'])->name('home_secation');

		Route::post('/business/secation/home-section-store',  [AllSecationController::class, 'HomeSecationStore'])->name('homesecation_store');

		Route::post('/business/secation/home-section-update',  [AllSecationController::class, 'HomeSecationUpdate'])->name('homesecation_update');



		//Start About Route

		Route::get('/business/secation/about-section',  [AllSecationController::class, 'AboutSecation'])->name('about_secation');

		Route::post('/business/secation/about-section-store',  [AllSecationController::class, 'AboutSecationStore'])->name('aboutsecation_store');

		Route::post('/business/secation/about-section-update',  [AllSecationController::class, 'AboutSecationUpdate'])->name('aboutsecation_update');

		//Start About Route



		Route::get('/business/secation/header-section',  [AllSecationController::class, 'HeaderSecation'])->name('header_secation');

		Route::post('/business/secation/header-section-store',  [AllSecationController::class, 'HeaderSecationStore'])->name('header_uplode');



		Route::get('/business/secation/footer-section',  [AllSecationController::class, 'FooterSecation'])->name('footer_secation');

		Route::post('/business/secation/footer-section-store',  [AllSecationController::class, 'FooterSecationStore'])->name('footer_uplode');

		Route::post('/business/secation/footer-remove',  [AllSecationController::class, 'FooterRemove'])->name('footer_remove');





		//Add Bank Managment



		Route::name('bank.')->prefix('bank')->controller(BankController::class)->group(function () {

			Route::get('/index', 'index')->name('index');

			Route::get('/add', 'add')->name('add');

			Route::get('/accountResponse/{accountId}', 'accountResponse')->name('accountResponse');

			Route::get('/manage', 'updateAccount')->name('manage_account');





		});



		// Route::get('add-bank', [BankAccountController::class, 'checkAccount'])->name('check');

		// Route::post('add-bankaccount', [BankAccountController::class, 'AddBankAccount'])->name('add.bankaccount');

		// Route::post('add-bankaccount-update', [BankAccountController::class, 'updateBankAccount'])->name('add.bankaccount.update');

		// Route::get('create', [BankAccountController::class, 'createAccount'])->name('bank-account.create');

		// Route::get('update', [BankAccountController::class, 'updateAccount'])->name('bank-account.update');

		// Route::any('response',[BankAccountController::class,'accountResponse'])->name('response');



	 //});







 });











//Admin Route

	Route::get('/admin', function () {

		return view('login');

	});



	Route::get('/forgot-password', function () {

		return view('auth/forgot-password');

	});

	Route::any('password_email',[AuthController::class,'password_email'])->name('password_email');

	Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');

	Route::post('submitResetPasswordForm', [AuthController::class, 'submitResetPasswordForm'])->name('submitResetPasswordForm');



    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');



	Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['admin','Isadmin']], function () {

	Route::get('dashboard', [HomeController::class,'index'])->name('dashboard');

	Route::get('edit-profile', [AdminController::class,'EditProfile'])->name('edit_profile');

	Route::post('update-profile', [AdminController::class,'UpdateProfile'])->name('update_profile');

	Route::get('change-password', [AdminController::class,'ChangePassword'])->name('change_password');

	Route::post('update-password', [AdminController::class,'UpdatePassword'])->name('update_password');



	//Business Management//

	Route::get('business/list', [BusinessController::class,'Index'])->name('business_list');

	Route::get('welcome/message/{id}', [BusinessController::class,'SendWelcomeUrl'])->name('welcome_message');

	Route::get('business/view/{id}', [BusinessController::class,'Details'])->name('business_detail');

	Route::post('business/delete', [BusinessController::class,'Remove'])->name('business_delete');

	Route::post('business/status', [BusinessController::class,'changeStatus'])->name('business_status');

	//End Business Management//



	//Cms

	Route::get('cms/page', [CmsController::class,'Index'])->name('cms_page');

	Route::get('cms/view/{id}', [CmsController::class,'view'])->name('cms_view');

	Route::get('cms/edit/{id}', [CmsController::class,'edit'])->name('cms_edit');

	Route::post('cms/update/{id}', [CmsController::class,'update'])->name('cms_update');

	//End Cms Management//



	//Faq

	Route::get('faq/page', [FaqController::class,'Index'])->name('faq_page');

	Route::get('faq/add', [FaqController::class,'Add'])->name('faq_add');

	Route::post('faq/store', [FaqController::class,'Store'])->name('faq_store');

	Route::get('faq/view/{id}', [FaqController::class,'view'])->name('faq_view');

	Route::get('faq/edit/{id}', [FaqController::class,'edit'])->name('faq_edit');

	Route::post('faq/update/{id}', [FaqController::class,'update'])->name('faq_update');

	Route::post('faq/delete', [FaqController::class,'Delete'])->name('faq_delete');

	//End Faq Management//





	//Event Category

	Route::get('event-category/page', [EventController::class,'Index'])->name('event_category_page');

	Route::get('event-category/add', [EventController::class,'Add'])->name('event_category_add');

	Route::post('event-category/store', [EventController::class,'Store'])->name('event_categroy_store');

	Route::get('event-category/view/{id}', [EventController::class,'view'])->name('event_category_view');

	Route::get('event-category/edit/{id}', [EventController::class,'edit'])->name('event_category_edit');

	Route::post('event-category/update/{id}', [EventController::class,'update'])->name('event_category_update');

	Route::post('event-category/delete', [EventController::class,'Delete'])->name('event_category_delete');

	Route::post('event-category/status', [EventController::class,'changeStatus'])->name('event_category_status');



	//End Event Category//





	//Business Club Type Category

	Route::get('club-type/page', [BusinessClubTypeController::class,'Index'])->name('clubtype_page');

	Route::get('club-type/add', [BusinessClubTypeController::class,'Add'])->name('clubtype_add');

	Route::any('club-type/store', [BusinessClubTypeController::class,'Store'])->name('clubtype_store');

	Route::get('club-type/view/{id}', [BusinessClubTypeController::class,'view'])->name('clubtype_view');

	Route::get('club-type/edit/{id}', [BusinessClubTypeController::class,'edit'])->name('clubtype_edit');

	Route::post('club-type/update/{id}', [BusinessClubTypeController::class,'update'])->name('clubtype_update');

	Route::post('club-type/delete', [BusinessClubTypeController::class,'Delete'])->name('clubtype_delete');

	Route::post('club-type/status', [BusinessClubTypeController::class,'changeStatus'])->name('clubtype_status');



	//End Business Club Type Category//





	//Get In Tuch  Management//

	Route::get('get-tuch/list', [HomeController::class,'InquiryList'])->name('inquiry_list');

	Route::post('get-tuch/delete', [HomeController::class,'Delete'])->name('inquiry_delete');



	//Contact Us  Management//

	Route::get('contact-us/list', [HomeController::class,'ContactUsList'])->name('contact_us_list');

	Route::post('contact-us/delete', [HomeController::class,'ContactUsDelete'])->name('contact_us_delete');





	//End Get In Tuch  Management//

    Route::post('logout', [AdminController::class,'logout'])->name('admin.logout');





});
