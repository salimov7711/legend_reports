<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\mkr_298\MonthsController;
use App\Http\Controllers\mkr_298\UserController;
use App\Http\Controllers\mkr_298\YearsController;
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
Route::group(['prefix' => 'photo-reports', 'middleware' => ['auth:sanctum', 'role:legend_tower']], function () {
    Route::get('/', [ReportController::class, 'index']);

    Route::get('/getUser', [ReportController::class, 'getUser']);
    Route::get('/all-reports', [ReportController::class, 'getAllReports']);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->withoutMiddleware('auth:sanctum');

    Route::group(['prefix' => 'category', 'middleware' => ['auth:sanctum', 'role:legend_tower']], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/get-all', [CategoryController::class, 'getAllCats']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::post('store', [CategoryController::class, 'store']);
        Route::post('/update/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/{category}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'report', 'middleware' => ['auth:sanctum']], function () {
        Route::get('/{report}', [ReportController::class, 'show']);
        Route::get('/reports-by-category/{category}', [ReportController::class, 'getReportsByCategory']);
        Route::post('/store', [ReportController::class, 'store'])->middleware('auth:sanctum');
        Route::delete('/delete/{report}', [ReportController::class, 'delete']);
        Route::post('/update/{report}', [ReportController::class, 'update']);
    });

});

Route::group(['prefix' => '298', 'middleware' => ['auth:sanctum', 'role:298_mkr']], function () {

    Route::post('/login', [UserController::class, 'login'])->withoutMiddleware('auth:sanctum');
    Route::get('/logout', [UserController::class, 'logout']);

    Route::group(['prefix' => 'years'], function () {
        Route::get('/', [YearsController::class, 'index']);
        Route::get('/{year}', [YearsController::class, 'show']);
        Route::post('/store', [YearsController::class, 'store']);
        Route::delete('/delete/{year}', [YearsController::class, 'delete']);
        Route::post('/update/{year}', [YearsController::class, 'update']);
    });

    Route::group(['prefix' => 'months'], function () {
        Route::get('/', [MonthsController::class, 'index']);
        Route::get('/{month}', [MonthsController::class, 'show']);
        Route::post('/store', [MonthsController::class, 'store']);
        Route::delete('/delete/{month}', [MonthsController::class, 'delete']);
        Route::post('/update/{month}', [MonthsController::class, 'update']);
    });


});
