<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TestingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',function (){
    return 'This is home page';
});

Route::get('/about', function(){
    dd('this is about page');
});

Route::get('getid/{id}',[TestController::class,'getid']);
Route::get('/studentlist',[CustomerController::class,'studenttable']);
Route::get('/test',[TestController::class,'testing']);
Route::get('/view/create',[TestController::class,'view_create']);
Route::post('/view/created',[TestController::class,'view_created']);