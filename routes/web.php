<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use Iluminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use PHPUnit\Metadata\Group;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\EmployeeController;
use Termwind\Components\Raw;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/demo-laravel', [DemoController::class, 'index']);

//gop router thanh 1 nhom
Route::group(['prefix' => 'category', 'middleware' => 'AuthMiddleware'], function() {
    Route::get('/detail/{id}', [DemoController::class, 'detail']);   
    Route::post('/update/{id}', [DemoController::class, 'update']);
    Route::get('/destroy/{id}', [DemoController::class, 'destroy']);
        
});
// Route::group(, function() {
    Route::get('/dashboard', [DashboardController::class, 'board']);
    //router for category
    Route::group(['prefix' => 'categories'], function() {
       Route::get('/index', [CategoryController::class, 'index']);
    });
    Route::group(['prefix' => 'storages'], function() {
        Route::get('/index', [StorageController::class, 'index']);
        Route::get('create', [StorageController::class, 'create']);  
        Route::post('store',[StorageController::class, 'store']);
        Route::get('/edit/{id}', [StorageController::class, 'edit']);
        Route::post('/update/{id}', [StorageController::class, 'update']);
        Route::get('/delete/{id}',[StorageController::class, 'delete']);
    });

    Route::group(['prefix' => 'receipts'], function() {
        Route::post('update/{id}', [ReceiptController::class, 'update']);
        Route::get('export', [ReceiptController::class, 'export']);
        Route::get('/index', [ReceiptController::class, 'index']);
        Route::get('/detail/{id}', [ReceiptController::class, 'detail']);
    });

    Route::group(['prefix' => 'employee'],function() {
        Route::get('/list', [EmployeeController::class, 'index']);
        Route::get('/index', [EmployeeController::class, 'index']);
        Route::get('/create', [EmployeeController::class, 'create']);
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::get('/detail/{id}', [EmployeeController::class, 'detail']);
        Route::post('/update/{id}', [EmployeeController::class, 'update']);

    });

    
// });


Route::get('/query-builder', [DemoController::class, 'queryBuilder']);
Route::get('/eloquent', [DemoController::class, 'eloquent']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);