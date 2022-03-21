<?php

use App\Http\Controllers\API\TestController;
use App\Http\Controllers\LabelApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::apiResource('labels', LabelApiController::class);
    return $request->user();
});


//public
Route::group([
                 'prefix'    => 'v1',
                 'as'        => 'api.'
             ], function () {
    Route::apiResource('test', TestController::class);
});