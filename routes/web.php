<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\RegisterController;
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

//Auth::routes();

Route::POST('/register',[RegisterController::class,'register'])->name('register');
Route::POST('/login',[LoginController::class,'login'])->name('login');
Route::view('/login','login');


Route::POST('/logout',[LoginController::class,'logout'])->name('logout');



Route::group(['middleware'=>'auth'], function(){
    Route::POST('/addcompany', [CompanyController::class, 'store']);
    Route::POST('/search', [CompanyController::class, 'getresult']);
    Route::PATCH('/updatecompany/{id}', [CompanyController::class, 'update']);
    Route::GET('/update', [HomeController::class, 'show']);
    Route::POST('/update', [HomeController::class, 'update']);
    Route::GET('/home', [HomeController::class, 'index'])->name('home');
    Route::DELETE('delete_home', [CompanyController::class, 'destroy'])->name('delete');
});

