<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@create');
Route::get('/checkEmail', 'Auth\RegisterController@checkEmail');
Route::get('/verify_email', 'Auth\RegisterController@verifyRegistration');

Route::middleware('auth:api')->group(function () {
  Route::post('/logout', 'Auth\LogoutController@logout');
  Route::get('/merchant_settings/getAuthenticatedUser', 'API\Merchant\SettingController@getAuthenticatedUser');

  Route::apiResources([
    'admin/customer'     => 'API\Admin\CustomerController',
    'admin/merchant'     => 'API\Admin\MerchantController',
    'admin/dasher'       => 'API\Admin\DasherController',

    'dasher'             => 'API\DasherController',
    'dasher_status'      => 'API\Dasher\StatusController',
    'deliveries'         => 'API\Dasher\DeliveryController',
    'ratings'            => 'API\Dasher\RatingController',

    'merchant_settings'  => 'API\Merchant\SettingController',
    'merchant_products'  => 'API\Merchant\ProductController',
    'product_categories' => 'API\Merchant\CategoryController',
    'orders'             => 'API\Merchant\CustomerOrderController',
    'order_status'       => 'API\Merchant\OrderStatusController',

    'customer'           => 'API\CustomerController',
    'stores'             => 'API\Customer\StoreController',
    'customer_orders'    => 'API\Customer\OrderController',
  ]);

  Route::get('/admin/getCustomerCount', 'API\Admin\CustomerController@customer_count');
  Route::get('/admin/getMerchantCount', 'API\Admin\MerchantController@merchant_count');
  Route::get('/admin/getDasherCount', 'API\Admin\DasherController@dasher_count');

  Route::get('/admin/getDasherRating', 'API\Admin\DasherController@getDasherRating');

  Route::get('/admin/transactions/getAnnualTransactionsCount', 'API\Admin\TransactionController@getAnnualTransactionsCount');
  Route::get('/admin/transactions/getMonthlyTransactionsCount', 'API\Admin\TransactionController@getMonthlyTransactionsCount');
  Route::get('/admin/transactions/getDateRangeTransactions', 'API\Admin\TransactionController@getDateRangeTransactions');

  Route::get('/admin/revenue/getAnnualRevenue', 'API\Admin\RevenueController@getAnnualRevenue');
  Route::get('/admin/revenue/getMonthlyRevenue', 'API\Admin\RevenueController@getMonthlyRevenue');
  Route::get('/admin/revenue/getDateRangeRevenue', 'API\Admin\RevenueController@getDateRangeRevenue');

  Route::get('/store_categories', 'API\Merchant\CategoryController@getCategories');
  Route::get('/store_products_by_category', 'API\Merchant\ProductController@getProductByCategories');
  Route::get('/store_getBanner', 'API\Merchant\ProductController@getBanner');

  Route::get('/getStoreDistanceInKM/{id}', 'API\Customer\StoreController@getStoreDistanceInKM');

  Route::post('/merchant_settings/changeBanner', 'API\Merchant\SettingController@changeBanner');

  Route::post('/orders/order_opened', 'API\Merchant\CustomerOrderController@order_opened');

  Route::get('/checkPendingDelivery', 'API\Dasher\StatusController@checkPendingDelivery');
});
