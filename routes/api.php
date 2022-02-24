<?php

use App\Http\Controllers\API\Inbound\BusinessListingApiInboundController;
use App\Http\Controllers\Api\Outbound\BusinessListingApiController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::prefix('v1')->group(function () {


    Route::controller(BusinessListingApiController::class)->group(function () {
        Route::post('/verify', 'verify');
    });


    Route::controller(BusinessListingApiInboundController::class)->group(function () {
        Route::post('company/data', 'setData');
    });
});
