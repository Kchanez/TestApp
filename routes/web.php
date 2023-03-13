<?php

use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// add offer
/* Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    // insert data to database
    Route::get('create', 'App\Http\Controllers\CrudController@Create');
    Route::post('store', 'App\Http\Controllers\CrudController@store')->name('offers.store');
    // get data frome data base
    Route::get('all', 'App\Http\Controllers\CrudController@getAllOffers');

    // Update offer
    Route::get('edit/{offer_id}', 'App\Http\Controllers\CrudController@editOffer');
    Route::post('update/{offer_id}', 'App\Http\Controllers\CrudController@updateOffer')->name('offers.update');

    //Delete offer
    Route::get('delete/{offer_id}', 'App\Http\Controllers\CrudController@deleteOffer')->name('offers.delete');

    //
    Route::get('youtube', 'App\Http\Controllers\CrudController@getVideo')
        ->middleware(['auth', 'verified'])->name('dashboard');
});
 */

//add offer with ajax
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    // insert data to database
    Route::get('create', 'OfferController@Create');
    Route::post('store', 'OfferController@store')->name('store');
    // get data frome data base
    Route::get('all', 'App\Http\Controllers\OfferController@getAllOffers');
    // Update offer
    Route::get('edit/{offer_id}', 'App\Http\Controllers\OfferController@editOffer');
    Route::post('update/{offer_id}', 'App\Http\Controllers\OfferController@updateOffer')->name('offers.update');

    //Delete offer
    Route::get('delete/{offer_id}', 'App\Http\Controllers\OfferController@deleteOffer')->name('offers.delete');

});

