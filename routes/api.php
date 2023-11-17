<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KanyeQuoteController;

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

Route::middleware('bearerToken')->group(function () {
    Route::get('/kanye-quote', [KanyeQuoteController::class, 'getRandomQuote']);
    Route::get('/kanye-quotes/{count?}/{next?}', [KanyeQuoteController::class, 'getMultipleRandomQuotes']);
});
