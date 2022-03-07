<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MenuTypeController;
use App\Http\Controllers\MenuItemController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::post('/profile', 'update')->name('profile.update');
    });

    Route::controller(RegisteredUserController::class)->group(function () {
        Route::post('/password', 'passwordUpdate')->name('password.change');
    });

    Route::controller(MenuTypeController::class)->group(function () {
        Route::get('/menu-type', 'index')->name('menu_type.index');
        Route::post('/menu-type', 'store')->name('menu_type.store');
        Route::delete('/menu-type', 'destroy')->name('menu_type.destroy');
        Route::put('/menu-type/update', 'update')->name('menu_type.update');
    });

    Route::controller(MenuItemController::class)->group(function () {
        Route::get('/menu-item', 'index')->name('menu_item.index');
        Route::post('/menu-item', 'store')->name('menu_item.store');
        Route::put('/menu-item/update', 'update')->name('menu_item.update');
        Route::delete('/menu-item', 'destroy')->name('menu_item.destroy');
    });

});

require __DIR__.'/auth.php';
