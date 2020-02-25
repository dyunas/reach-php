<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\PlacedOrder;

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

Route::middleware('auth:api')->group(function () {
  Route::post('/logout', 'Auth\LogoutController@logout');
  Route::get('/merchant_settings/getAuthenticatedUser', 'API\Merchant\SettingController@getAuthenticatedUser');

  Route::apiResources([
    'customer'           => 'API\CustomerController',
    'dasher'             => 'API\DasherController',
    'dasher_status'      => 'API\Dasher\StatusController',
    'deliveries'         => 'API\Dasher\DeliveryController',
    'merchant_settings'  => 'API\Merchant\SettingController',
    'merchant_products'  => 'API\Merchant\ProductController',
    'product_categories' => 'API\Merchant\CategoryController',
    'orders'             => 'API\Merchant\CustomerOrderController',
    'order_status'       => 'API\Merchant\OrderStatusController',
    'stores'             => 'API\Customer\StoreController',
    'customer_orders'    => 'API\Customer\OrderController',
  ]);

  Route::get('/store_categories', 'API\Merchant\CategoryController@getCategories');
  Route::get('/store_products_by_category', 'API\Merchant\ProductController@getProductByCategories');

  Route::post('/orders/order_opened', 'API\Merchant\CustomerOrderController@order_opened');

  Route::get('/checkPendingDelivery', 'API\Dasher\StatusController@checkPendingDelivery');
});
