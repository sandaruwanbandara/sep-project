<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MenuTypeController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuController;
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
        return Inertia::render('Welcome');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::post('/profile', 'update')->name('profile.update');
        Route::post('/delete', 'destroy')->name('profile.delete');
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

    Route::controller(MenuController::class)->group(function () {
        Route::get('/menu', 'index')->name('menu.index');
        Route::post('/menu', 'store')->name('menu.store');
        Route::put('/menu/update', 'update')->name('menu.update');
        Route::delete('/menu', 'destroy')->name('menu.destroy');
        Route::get('/menu/{id}', 'show')->name('menu.show');
        Route::post('/menu/add', 'addItem')->name('menu.item.add');
        Route::delete('/menu/remove', 'deleteItem')->name('menu.item.remove');
    });

});

require __DIR__.'/auth.php';
