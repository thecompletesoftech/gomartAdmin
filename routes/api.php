<?php

use App\Http\Controllers\Api\V1\Customer\CTestController;
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

Route::get('/v1/test', 'Api\V1\TestController@test');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['optimizeImages'], 'prefix' => '/v1/customer', 'namespace' => 'Api\V1\Customer'], function () {
    
    Route::get('/test', [CTestController::class, 'test']);

    // -------- Register And Login API ----------
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('userRegister', 'userRegister');
        Route::post('sendOtp', 'sendOtp');
        Route::post('verifyOtp', 'verifyOtp');
        Route::post('forgetPassword', 'forgetPassword');
        
        
    });

    // -------- Register And Login API ----------
    Route::group(['middleware' => ['jwt.auth']], function () {
        /* logout APi */
        Route::controller(AuthController::class)->group(function () {
            Route::post('logout', 'logout');
            Route::post('addOrder', 'addOrder');
            Route::post('getCategory', 'getCategory');
            Route::post('getProduct', 'getProduct');
            Route::post('getBanner', 'getBanner');
            Route::post('cancelOrder', 'cancelOrder');
        });

        /* Profile Controller */
        Route::controller(CProfileController::class)->group(function () {
            /*Profile API */
            Route::get('profile', 'profile');
            Route::put('update-profile', 'updateProfile');
            Route::post('update-profile-image', 'updateProfileImage');
        });
        
    });
});