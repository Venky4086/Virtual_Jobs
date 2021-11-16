<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\jobController;
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


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'apiauth'], function () {
        Route::post('add-employee', [jobController::class, 'add_employee']);
        Route::post('add_employer',[jobController::class, 'add_employer'])->name('add_employer');
        Route::post('googlelogin', [jobController::class, 'googlelogin']);
        Route::post('auth/google/callback', [jobController::class,  'handleGoogleCallback']);
        Route::post('skillset', [jobController::class,  'skillset']);
    });
    Route::get('verify/{token}',[jobController::class, 'VerifyEmail'])->name('verify');

});
