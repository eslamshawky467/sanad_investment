<?php
use Illuminate\Support\Facades\Route;
Route::prefix('user')->middleware('checkLang')->group( function () {
    Route::post('password/email',  [App\Http\Controllers\Api\ForgotPasswordController::class,'forget']);
    Route::post('password/code/check', [App\Http\Controllers\Api\CodeCheckController::class,'code']);
    Route::post('password/reset', [App\Http\Controllers\Api\ResetPasswordController::class]);
});
Route::prefix('user')->controller(App\Http\Controllers\Api\UserAuthController::class)->middleware('checkLang')->group(function () {
    Route::post('login', [App\Http\Controllers\Api\UserAuthController::class,'login']);
      Route::post('checkcode', [App\Http\Controllers\Api\UserAuthController::class,'checkcode']);
    Route::post('register', [App\Http\Controllers\Api\UserAuthController::class,'register']);
    Route::post('index', [App\Http\Controllers\Api\UserAuthController::class,'index']);
    Route::post('logout',[App\Http\Controllers\Api\UserAuthController::class, 'logout']);
    Route::post('me', [App\Http\Controllers\Api\UserAuthController::class,'me']);
    Route::post('refresh', [App\Http\Controllers\Api\UserAuthController::class,'refresh']);
    Route::post('/profile/change-password',[App\Http\Controllers\Api\UserAuthController::class,'change_password']);
    Route::post('/profile/update-profile',[App\Http\Controllers\Api\UserAuthController::class,'update_profile']);
    Route::post('/make-account',[App\Http\Controllers\Api\AccountController::class,'make_account']);
    Route::post('/make-transaction',[App\Http\Controllers\Api\AccountController::class,'make_transaction']);
    Route::post('/make-invest',[App\Http\Controllers\Api\AccountController::class,'make_invest']);
    Route::post('/refund',[App\Http\Controllers\Api\AccountController::class,'refund']);
    Route::post('/withdraw',[App\Http\Controllers\Api\AccountController::class,'withdraw']);
      Route::post('/destroy',[App\Http\Controllers\Api\AccountController::class,'destroy_account']);
          Route::get('/has_account',[App\Http\Controllers\Api\AccountController::class,'has_account']);
    Route::get('/balance',[App\Http\Controllers\Api\AccountController::class,'balance']);
    Route::get('/withdraw_balance',[App\Http\Controllers\Api\AccountController::class,'withdraw_balance']);
    Route::get('/units',[App\Http\Controllers\Api\AccountController::class,'units']);
    Route::get('/all_transactions',[App\Http\Controllers\Api\AccountController::class,'all_transaction']);
    Route::post('/request_sell',[App\Http\Controllers\Api\AccountController::class,'request_sell']);
 Route::get('/user_props',[App\Http\Controllers\Api\AccountController::class,'properties']);
    Route::post('/StoreToken',[App\Http\Controllers\Api\NotifyController::class,'StoreToken']);
    Route::post('send-notification', [App\Http\Controllers\Admin\NotifyController::class, 'send']);

    Route::get('/banners',[App\Http\Controllers\Api\AccountController::class,'banner']);
    Route::get('/payment',[App\Http\Controllers\Api\AccountController::class,'payment']);
       Route::get('/benfits',[App\Http\Controllers\Api\AccountController::class,'benfits']);
    Route::get('/destroy-account',[App\Http\Controllers\Api\AccountController::class,'destroy_account']);
        Route::get('/getallnotify',[App\Http\Controllers\Api\AccountController::class,'getallnotification']);
});

