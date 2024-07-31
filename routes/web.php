<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth0Controller;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth0',[Auth0Controller::class,'auth0']);

Route::get('callback',[Auth0Controller::class,'callback']);


