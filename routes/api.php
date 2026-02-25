<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\InvestmentAccountController;
use App\Http\Controllers\Api\TradeController;

// Public test route
Route::get('/test', function() {
    return response()->json([
        'message' => 'NSE AI Trading API is working',
        'status' => 'online'
    ]);
});

// Investor routes
Route::apiResource('investors', InvestorController::class);
Route::get('/investors/{investor}/portfolio', [InvestorController::class, 'portfolio']);

// Investment Account routes
Route::apiResource('investment-accounts', InvestmentAccountController::class);
Route::get('/investment-accounts/{investment_account}/trades', [InvestmentAccountController::class, 'trades']);

// Trade routes
Route::post('/trades', [TradeController::class, 'store']);
Route::get('/trades/recent', [TradeController::class, 'recent']);