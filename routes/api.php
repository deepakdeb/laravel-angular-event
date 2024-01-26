<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/events', [EventController::class, 'list'])->name('events.list');
Route::get('/event/{slug}', [EventController::class, 'get_event'])->name('event.get_event');

Route::post('/register/{slug}', [RegistrationController::class, 'register'])->name('event.register');
