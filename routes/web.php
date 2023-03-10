<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AddressController;
use \App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/api/user', [ UserController::class, 'createUser' ]);
Route::post('/api/address', [ AddressController::class, 'createAddress']);
Route::post('/api/account', [ AccountController::class, 'createAccount' ]);
