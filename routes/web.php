<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;

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

Auth::routes();



Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    Route::post('/events/{id}', [EventController::class, 'storeOrUpdate'])->name('events.storeOrUpdate');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');

    // resource route Start
    Route::resource('events', EventController::class);
    // resource route End
});
