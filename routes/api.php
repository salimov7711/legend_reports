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


Route::group(['middleware' => ['auth:sanctum']], function () {

});
Route::group(['prefix' => 'photo-reports'], function () {
    Route::get('/', [ReportController::class, 'index']);

    Route::get('/getUser', [ReportController::class, 'getUser'])->middleware('auth:sanctum');
    Route::get('/all-reports', [ReportController::class, 'getAllReports']);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

    Route::group(['prefix' => 'category' ,'middleware' => ['auth:sanctum']], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/get-all', [CategoryController::class, 'getAllCats']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::post('store', [CategoryController::class, 'store']);
        Route::post('/update/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/{category}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'report',  'middleware' => ['auth:sanctum']], function () {
        Route::get('/{report}', [ReportController::class, 'show']);
        Route::get('/reports-by-category/{category}', [ReportController::class, 'getReportsByCategory']);
        Route::post('/store', [ReportController::class, 'store'])->middleware('auth:sanctum');
        Route::delete('/delete/{report}', [ReportController::class, 'delete']);
        Route::post('/update/{report}', [ReportController::class, 'update']);
    });

});
