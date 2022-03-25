<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\LabelApiController;
use App\Http\Controllers\API\TestController;

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
// Auth
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('signup', [AuthController::class, 'signup'])->name('auth.signup');
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('auth.logout');
        Route::get('user', [AuthController::class, 'getAuthenticatedUser'])->middleware('auth:sanctum')->name(
            'auth.user'
        );
        Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware(
            'throttle:5,1'
        )->name('password.email');
        Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
    });
});
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    Route::apiResource('labels', LabelApiController::class);
//    return $request->user();
//});



//public
Route::group([
                 'prefix' => 'v1',
                 'as'     => 'api.'
             ], function () {
    Route::apiResource('test', TestController::class);
    Route::apiResource('label', LabelApiController::class);
});
