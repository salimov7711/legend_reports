<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'photo-reports'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::post('store', [CategoryController::class, 'store']);
        Route::patch('/update/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/{category}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/reports-by-category/{category}', [ReportController::class, 'getReportsByCategory']);
        Route::post('/store', [ReportController::class, 'store']);
        Route::delete('/delete', [ReportController::class, 'delete']);
    });

});
