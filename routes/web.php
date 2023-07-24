<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin as AdminLogin;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

// Admin Login controller
Route::get('admin_console',[AdminLogin::class,'index']);
Route::post('admin_console/verify_',[AdminLogin::class,'verify']);

