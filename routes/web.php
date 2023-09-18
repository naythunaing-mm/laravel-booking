<?php
use App\Helpers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bed\BedController;
use App\Http\Controllers\view\ViewController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Amenity\AmenityController;
use App\Http\Controllers\errors\RouteErrorController;
use App\Http\Controllers\Frontend\frontendController;
use App\Http\Controllers\SpecialFeature\SpecialFeatureController;


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
Route::get('/',[frontendController::class,'index'])->name('frontendindex');
Route::get('about',[frontendController::class,'about'])->name('about');
Route::get('contact',[frontendController::class,'contact']);

Route::get('admin-backend/login',[LoginController::class,'getLogin'])->name('login');
Route::get('admin-backend/logout',[LoginController::class,'getLogout'])->name('logout');
Route::post('admin-backend/login',[LoginController::class,'postlogin'])->name('postlogin');

Route::group(['prefix' => 'admin-backend','middleware' => 'admin'], function () {
    Route::get('index', [HomeController::class,'index'])->name('index');

    // for view table
    Route::prefix('view')->group(function () {
        Route::get('edit/{id}',[ViewController::class,'viewEdit']);
        Route::get('delete/{id}',[ViewController::class,'viewdelete']);
        Route::get('create', [ViewController::class,'form'])->name('ViewForm');
        Route::get('listing',[ViewController::class,'viewListing'])->name('viewListing');
        Route::post('created', [ViewController::class,'create'])->name('viewCreate');
        Route::post('updated',[ViewController::class,'viewUpdate'])->name('viewUpdate');

    });
    
    // for bed table 
    Route::prefix('bed')->group(function () {
        Route::get('edit/{id}',[BedController::class,'BedEdit']);
        Route::get('delete/{id}',[BedController::class,'BedDelete']);
        Route::get('create',[BedController::class,'BedForm'])->name('BedForm');
        Route::get('listing',[BedController::class,'BedListing'])->name('BedListing');
        Route::post('created', [BedController::class,'BedCreate'])->name('BedCreate');
        Route::post('updated',[BedController::class,'BedUpdate'])->name('BedUpdate');
        
    });
    

    // for amenity table 
    Route::prefix('amenity')->group(function () {
        Route::get('edit/{id}',[AmenityController::class,'AmenityEdit']);
        Route::get('delete/{id}',[AmenityController::class,'AmenityDelete']);
        Route::get('create',[AmenityController::class,'AmenityForm'])->name('AmenityForm');
        Route::get('listing',[AmenityController::class,'AmenityListing'])->name('AmenityListing');
        Route::post('created', [AmenityController::class,'AmenityCreate'])->name('AmenityCreate');
        Route::post('updated',[AmenityController::class,'AmenityUpdate'])->name('AmenityUpdate');
        
    });

    // for room table 
    Route::prefix('room')->group(function () {
        Route::get('edit/{id}',[RoomController::class,'RoomEdit']);
       
        Route::get('delete/{id}',[RoomController::class,'RoomDelete']);
        Route::get('create',[RoomController::class,'RoomForm'])->name('RoomForm');
        Route::get('listing',[RoomController::class,'RoomListing'])->name('RoomListing');
        Route::get('edit/{id}',[RoomController::class,'RoomEdit']);
        Route::post('update',[RoomController::class,'RoomUpdate'])->name('RoomUpdate');
        Route::post('created', [RoomController::class,'RoomCreate'])->name('RoomCreate');
        Route::post('updated',[RoomController::class,'RoomUpdate'])->name('RoomUpdate');
        Route::get('room-gallery/{id}',[RoomController::class,'galleryForm'])->name('galleryForm');
        Route::get('room-gallery/delete/{id}',[RoomController::class,'deleteGallery']);
        Route::get('room-gallery/edit/{id}',[RoomController::class,'editGallery']);
        Route::post('room-gallery/update',[RoomController::class,'updateGallery'])->name('updateGallery');
        Route::post('room-gallery/create',[RoomController::class,'galleryCreate'])->name('roomGallery');
        
    });

    // for special feature 
    Route::prefix('feature')->group(function () {
        Route::get('edit/{id}',[SpecialFeatureController::class,'FeatureEdit']);
        Route::get('delete/{id}',[SpecialFeatureController::class,'FeatureDelete']);
        Route::get('create',[SpecialFeatureController::class,'FeatureForm'])->name('FeatureForm');
        Route::get('listing',[SpecialFeatureController::class,'FeatureListing'])->name('FeatureListing');
        Route::post('created', [SpecialFeatureController::class,'FeatureCreate'])->name('FeatureCreate');
        Route::post('updated',[SpecialFeatureController::class,'FeatureUpdate'])->name('FeatureUpdate');
        
    });

    // route error 
    // Route::get('/error',[RouteErrorController::class,'RouteError'])->name('RouteError');
});

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
