<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserTransactionController;
use App\Http\Controllers\Admin\Account_adminController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\WithdrawController;
use Illuminate\Support\Facades\Session;


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['namespace' => 'Auth','middleware' => 'prevent-back-history'], function () {
    Route::get('/register/{type}', [RegisterController::class, 'reg'])->middleware('guest')->name('reg');
//    Route::get('/register', 'RegisterController@regs')->name('regs');
  //  Route::post('/register', 'RegisterController@signup')->name('register');

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('/login/{type}', [LoginController::class, 'log'])->name('login.show');
    Route::get('/login', 'LoginController@logs')->name('logs');
    Route::post('/login', 'LoginController@login')->name('login');
  
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth','prevent-back-history']
    ], function () {
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::group(['namespace' => 'Auth'], function () {
       Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
    });
    Route::group(['namespace' => 'Admin'], function () {
       Route::resource('admins', 'AdminController');
        Route::delete('/admin/bulk_delete', [AdminController::class, "bulkDelete"])->name('admin.bulk_delete');
        Route::get('search/admin', 'AdminController@search');
        Route::get('/deletesearch/{id}', [AdminController::class, 'deletesearch'])->name('deletesearch');
        Route::get('/editadmin/{id}', [AdminController::class, 'editsearch'])->name('editsearch');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
       
        Route::post('/updateprofile/{id}', [AdminController::class, 'updateprofile'])->name('updateprofile');
        Route::resource('users', 'UserController');
        Route::delete('/user/bulk_delete', [UserController::class, "bulkDelete"])->name('user.bulk_delete');
        Route::get('search/user', 'UserController@search');
        Route::get('/deleteuser/{id}', [UserController::class, 'deleteuser'])->name('deleteuser');
        Route::get('/edituser/{id}', [UserController::class, 'edituser'])->name('edituser');
        Route::resource('properties', 'PropertyController');
        Route::get('/profile',[AdminController::class,'profile'])->name('profile');
        Route::get('/DeleteProperity/{id}',[PropertyController::class,'deletesearch'])->name('properties.DeleteProperity');
        Route::post('updateProperity/{id}',[PropertyController::class,'updateProperity'])->name('properties.updateProperity');




        Route::delete('/property/bulk_delete',[PropertyController::class,'bulkDelete'])->name('properties.bulk_delete');
        Route::get('search/properity', 'PropertyController@search');
        Route::get('/overview', 'AdminController@overview')->name('overview');
        Route::post('/download', [AccountController::class, 'dFile'])->name('download');
        Route::resource('transactions', 'UserTransactionController');
        Route::delete('/transaction/bulk_delete', [UserTransactionController::class, "bulkDelete"])->name('transaction.bulk_delete');
        Route::get('search/transactions', 'UserTransactionController@search');
        Route::get('/deletetransaction/{id}', [UserTransactionController::class, 'deletetransaction'])->name('deletetransaction');
        Route::get('/edittransaction/{id}', [UserTransactionController::class, 'edittransaction'])->name('edittransaction');


        Route::resource('accounts', 'AccountController');
        Route::delete('/account/bulk_delete', [AccountController::class, "bulkDelete"])->name('account.bulk_delete');
        Route::get('search/accounts', 'AccountController@search');
        Route::get('/deleteaccount/{id}', [AccountController::class, 'deleteaccount'])->name('deleteaccount');
        Route::get('/editaccount/{id}', [AccountController::class, 'editaccount'])->name('editaccount');
        Route::get('/approved/{id}', [AccountController::class, 'approved'])->name('approved');
        Route::get('/canceled/{id}', [AccountController::class, 'canceled'])->name('canceled');
        Route::get('/show_details/{id}', [AccountController::class, 'show_details'])->name('show_details');
        Route::get('/showactive/{id}',[AccountController::class,'show_active'])->name('show_active');
        Route::post('/active',[AccountController::class,'active'])->name('active');
                Route::get('/showinactive/{id}',[AccountController::class,'showinactive'])->name('showinactive');
        Route::post('/inactive',[AccountController::class,'inactive'])->name('inactive');
        
        
         Route::get('/showsell/{id}',[AccountController::class,'show_sell'])->name('show_sell');
        Route::post('/sell_unit',[AccountController::class,'sell_unit'])->name('sell_unit');

        Route::resource('settings','SettingsConroller');
        Route::post('deleteAll','SettingsConroller@DeleteMany')->name('settings.DeleteMany');
        Route::get('search/settings', 'SettingsConroller@search')->name('settings.SearchSetting');
        Route::get('/DeleteSetting/{id}','SettingsConroller@DeleteSetting')->name('settings.DeleteSetting');
        Route::get('/EditeSetting/{type}','SettingsConroller@editSetting')->name('settings.EditSetting');
        Route::post('/UpdateSetting/{type}','SettingsConroller@updateSetting')->name('settings.UpdateSetting');


        Route::resource('investments', 'InvestmentController');
        Route::get('/show_investments/{id}', [InvestmentController::class, 'show_investments'])->name('show_investments');
        Route::get('/show_to_invest/{id}', [PropertyController::class, 'showtosell'])->name('showtosell');

        Route::resource('accounts_admin','Account_adminController');
        Route::get('/editaccount_admin/{id}', [Account_adminController::class, 'editaccount_admin'])->name('editaccount_admin');
        Route::resource('payment','PaymentController');
        Route::get('/sendNotificationToUser/{id}',[UserController::class,'sendNotificationrToUser'])->name('sendNotificationToUser');
        Route::resource('Image','CategoryController');


        Route::resource('person','PersonController');
        Route::resource('image','ImageController');

        Route::post('/transform_admin',[Account_adminController::class,'transform'])->name('transform');

       Route::get('/transformed',[Account_adminController::class,'get_trans'])->name('transformed');


        // Notification Controllers
        Route::post('send',[PushNotificationController::class, 'bulksend'])->name('bulksend');
        Route::get('all-notifications', [PushNotificationController::class, 'index'])->name('all-notifications');
        Route::get('get-notification-form', [PushNotificationController::class, 'create'])->name('notifications');

        Route::get('/search/notifications', [PushNotificationController::class, 'search']);






        Route::post('/make-invest',[Account_adminController::class,'make_invest'])->name('make_invest');


        Route::get('/show_to_invest', [PropertyController::class, 'showtosell'])->name('showtosell');



        Route::resource('withdraw', 'WithdrawController');
        Route::delete('/withdraws/bulk_delete', [WithdrawController::class, "bulkDelete"])->name('withdraw.bulk_delete');


        Route::get('/search/withdraw' , 'WithdrawController@search');


        Route::get('/deletetransaction/{id}', [WithdrawController::class, 'deletetransaction'])->name('deletetransaction');



        Route::get('/deletenotifications/{id}', [PushNotificationController::class, 'deletenotifications'])->name('deletenotifications');


        Route::resource('refund', 'RefundController');
        Route::delete('/Refunds/withdraws', [RefundController::class, "bulkDelete"])->name('refund.bulk_delete');


        Route::get('/search/refunds' , 'RefundController@search');


        Route::get('/deletetransaction/{id}', [RefundController::class, 'deletetransaction'])->name('deletetransaction');


        Route::get('/deletefile/{id}', [AccountController::class, 'deletefile'])->name('deletefile');


        Route::get('/search/investments' , 'InvestmentController@search');



        Route::resource('sell', 'SellController');

        Route::get('/search/sells' , 'SellController@search');

        Route::get('prop/index' , 'SellController@prop')->name('prop.index');


        Route::get('/withd/{id}','Account_adminController@withd')->name('withdraws');
        Route::post('/within','Account_adminController@withdraws')->name('withdrawn');

        Route::get('/destroyimage/{id}','ImageController@destroyimage')->name('destroyimage');
        Route::get('/editperson/{id}','PersonController@editperson')->name('editperson');
        Route::get('/deleteperson/{id}','PersonController@deleteperson')->name('deleteperson');
        
        Route::get('/info/pdf', [AdminController::class, 'createPDF']);
        
    });
});


