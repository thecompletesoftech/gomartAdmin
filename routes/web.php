<?php

use App\Http\Controllers\Admin\AdminErrorPageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CatgeoryController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RatingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    Route::get('/', function () {
         return redirect()->route('admin.login');
    });

    Auth::routes(['register' => false]);
    
    Route::group(['middleware' => ['optimizeImages'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::controller(AdminErrorPageController::class)->group(function () {
        Route::get('/404', 'pageNotFound')->name('notfound');
        Route::get('/500', 'serverError')->name('server_error');
    });
    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/test', 'test')->name('test');
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('dashboard-counts', 'dashboardCountsData')->name('dashboard-counts');
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::get('change-password', 'changePassword')->name('change_password');
            Route::put('change-password/{user}', 'updatePassword')->name('update.password');
        });

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);


        Route::controller(UserController::class)->group(function () {
            Route::get('/update_language/{user}/{language}', 'updateLanguage')->name('users.update_language');
            Route::get('/users/status/{id}/{status}', 'status')->name('users.status');
            Route::get('/users/destroy/{id}/', 'destroy')->name('users.destroy');
            Route::post('/users/download', 'export')->name('users.download');
        });

        Route::resource('/users', UserController::class);
     

        //Category

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categorys/status/{id}/{status}', 'status')->name('categorys.status');
            Route::get('/categorys/destroy/{id}/', 'destroy')->name('categorys.destroy');
        });
        Route::resource('/categorys', CategoryController::class);

        //Items

        Route::controller(ItemController::class)->group(function () {
            Route::get('/items/status/{id}/{status}', 'status')->name('items.status');
            Route::get('/items/destroy/{id}/', 'destroy')->name('items.destroy');
        });
        Route::resource('/items',ItemController::class);

        //Banners

        Route::controller(BannerController::class)->group(function () {
            Route::get('/banners/status/{id}/{status}', 'status')->name('banners.status');
            Route::get('/banners/destroy/{id}/', 'destroy')->name('banners.destroy');
        });
        Route::resource('/banners',BannerController::class);

        //Notifications

        Route::controller(NotificationController::class)->group(function () {
            Route::get('/notifications/status/{id}/{status}', 'status')->name('notifications.status');
            Route::get('/notifications/destroy/{id}/', 'destroy')->name('notifications.destroy');
        });
        Route::resource('/notifications',NotificationController::class);

        //orders

        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders/status/{id}/{status}', 'status')->name('orders.status');
            Route::get('/orders/destroy/{id}/', 'destroy')->name('orders.destroy');
        });
        Route::resource('/orders',OrderController::class);

        //ratings

        Route::controller(RatingController::class)->group(function () {
            Route::get('/reviews/status/{id}/{status}', 'status')->name('reviews.status');
            Route::get('/reviews/destroy/{id}/', 'destroy')->name('reviews.destroy');
        });
        Route::resource('/reviews',RatingController::class);

        // global 

        Route::controller(GlobalController::class)->group(function () {
            Route::get('/globals/edit/{id}/', 'edit')->name('globals.edit');
        });
        Route::resource('/globals',GlobalController::class);

        //currencys

        Route::controller(CurrencyController::class)->group(function () {
            Route::get('/currencys/status/{id}/{status}', 'status')->name('currencys.status');
            Route::get('/currencys/destroy/{id}/', 'destroy')->name('currencys.destroy');
        });
        Route::resource('/currencys',CurrencyController::class);

        //coupan

        Route::controller(CoupanController::class)->group(function () {
            Route::get('/coupans/status/{id}/{status}', 'status')->name('coupans.status');
            Route::get('/coupans/destroy/{id}/', 'destroy')->name('coupans.destroy');
        });
        Route::resource('/coupans',CoupanController::class);

        // language

        Route::controller(LanguageController::class)->group(function () {
            Route::get('/languages/status/{id}/{status}', 'status')->name('languages.status');
            Route::get('/languages/destroy/{id}/', 'destroy')->name('languages.destroy');
        });
        Route::resource('/languages',LanguageController::class);

        // commission
        
        Route::controller(CommissionController::class)->group(function () {
            Route::get('/commissions/edit/{id}/', 'edit')->name('commissions.edit');
        });
        Route::resource('/commissions',CommissionController::class);

        // radius
        
        Route::controller(RadiusController::class)->group(function () {
            Route::get('/radiuss/edit/{id}/', 'edit')->name('radiuss.edit');
        });
        Route::resource('/radiuss',RadiusController::class);

        //Setting manager
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings/general', 'edit_general')->name('settings.edit_general');
            Route::post('/settings/general', 'update_general')->name('settings.update_general');
        });

    });
});

// Route::get('/users/search', 'UserController@search');
// Route::get('/search','UserController@search');
// routes/web.php

Route::get('/search', [App\Http\Controllers\Admin\PersonalController::class, 'search'])->name('search');
Route::post('/store/{user_id}/{adventure_id}', [App\Http\Controllers\Admin\PersonalController::class, 'store'])->name('store');

Route::get('/reset-password',[UserController::class,'resetPasswordLoad']);
Route::post('/reset-password',[UserController::class,'resetPassword']);