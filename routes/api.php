<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\OrderController;

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

Route::group([
    'middleware' => 'api',
   
], function ($router) {
    Route::get('/homepage', [ApiController::class, 'homepagenew']);
    Route::get('/homepagenew', [ApiController::class, 'homepagenew']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/account_create', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/userdetails_get', [AuthController::class, 'userdetails_get']);
    Route::post('/userdetails_update', [AuthController::class, 'userdetails_update']);
    Route::post('/password_reset', [AuthController::class, 'password_reset']);

  //  Route::get('/countries_get', [AuthController::class, 'countries_get']);
  //  Route::get('/categories_get', [AuthController::class, 'getCategories']);


});
Route::group([
    'middleware' => 'api',
    'prefix' => 'prd'
], function ($router) {   
    
  
	Route::get('/products_get', [ApiController::class, 'products_get']);
	Route::get('/categories_get', [ApiController::class, 'categories_get']);
	Route::get('/countries_get', [ApiController::class, 'countries_get']);

    Route::post('/product_details', [ApiController::class, 'product_details']);
    



});
Route::group([
    'middleware' => 'api',
    'prefix' => 'order'
], function ($router) {  

        Route::post('/cart_action', [OrderController::class, 'cart_add']);

        Route::get('/cart_list', [OrderController::class, 'cart_list']);

        Route::post('/address_action', [OrderController::class, 'address_action']);

        Route::get('/address_list', [OrderController::class, 'address_list']);

        Route::post('/place_order', [OrderController::class, 'place_order']);
    });






