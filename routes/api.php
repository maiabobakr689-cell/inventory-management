<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function () {

    // Admin and Employee can view categories
    Route::get('/categories', [CategoryController::class, 'index']);

    // Only Admin can manage categories
    Route::middleware('role:admin')->group(function () {
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    });

});


Route::middleware('auth:sanctum')->group(function () {

    // Admin and Employee can view products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/search', [ProductController::class, 'search']);

    // Only Admin can manage products
    Route::middleware('role:admin')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    });

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/stock-movements', [StockMovementController::class, 'store']);

    Route::get('/stock-movements', [StockMovementController::class, 'index']);

});


Route::middleware('auth:sanctum')->group(function () {

    // Admin and Employee can view suppliers
    Route::get('/suppliers', [SupplierController::class, 'index']);

    // Only Admin can manage suppliers
    Route::middleware('role:admin')->group(function () {
        Route::post('/suppliers', [SupplierController::class, 'store']);
        Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
        Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);
    });

});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/inventory-report', [InventoryReportController::class, 'index']);

    Route::get('/supplier-purchases-report', [InventoryReportController::class, 'supplierPurchases']);

    Route::get('/low-stock-alerts', [InventoryReportController::class, 'lowStockAlerts']);

});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'message' => 'Authenticated user.',
        'user' => $request->user()
    ]);
});

