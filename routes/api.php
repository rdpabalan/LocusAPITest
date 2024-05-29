<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\LocusController;

// Define the route for the APIController's post method
Route::match(['get', 'post'], '/post', [APIController::class, 'post']);

Route::post('/riders', [RiderController::class, 'store']);
Route::get('/riders', [RiderController::class, 'index']);

Route::post('/samples', [SampleController::class,'store']);
Route::get('/samples', [SampleController::class,'index']);

Route::post('/order_callbacks', [LocusController::class,'store']);
Route::get('/order_callbacks', [LocusController::class,'index']);