<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('categories',[CategoryController::class,'show']);

Route::post('categories',[CategoryController::class,'add']);

// Route::patch('lots',[CategoryController::class,'show']);

Route::post('lots',[LotController::class,'add']);

Route::patch('lots/{id}',[LotController::class,'update']);

Route::get('auctions',[AuctionController::class,'show']);

Route::post('auctions',[AuctionController::class,'add']);

Route::patch('auctions/{id}',[AuctionController::class,'endAuction']);

Route::delete('auctions/{id}',[AuctionController::class,'delete']);

Route::post('bids',[BidController::class,'add']);

Route::get('bids/{id}',[BidController::class,'show']);
