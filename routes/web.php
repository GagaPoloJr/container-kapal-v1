<?php

use App\Livewire\Customers;
use App\Livewire\Roles;
use App\Livewire\Settings;
use App\Livewire\Trucks;
use App\Livewire\Users;
use App\Livewire\Users\UserUpdate;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/test', function () {
        return view('test');
    })->name('test');
    Route::get('/default', function () {
        return view('default');
    })->name('default');
    Route::get('/forms', function () {
        return view('form-elements');
    })->name('forms');


   
    Route::prefix('master')->group(function () {
        Route::get('trucks', Trucks::class)->name('trucks');
        Route::get('customers', Customers::class)->name('customers');
        Route::get('users', Users::class)->name('users');
        Route::get('users/{id}/edit', UserUpdate::class)->name('users.edit');
        Route::get('/settings', Settings::class)->name('settings.index');

        Route::get('roles', Roles::class)->name('roles');
        Route::get('roles/{role}/access', [Roles::class, 'access'])->name('roles.access');
        Route::post('roles/{role}/store-permissions', [Roles::class, 'store_permissions'])->name('roles.store-permissions');
    });


});
