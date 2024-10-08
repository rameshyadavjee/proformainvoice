<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function() 
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('clients', App\Http\Controllers\ClientController::class);
    Route::resource('items', App\Http\Controllers\ItemController::class);
    Route::resource('proforma', App\Http\Controllers\ProformaController::class);
    
    Route::get('/get-client-data', [App\Http\Controllers\ProformaController::class, 'getClientData'])->name('get.client.data');
    Route::get('/get-item-data', [App\Http\Controllers\ProformaController::class, 'getItemData'])->name('get.item.data');
    Route::get('/proforma/{id}/download', [App\Http\Controllers\ProformaController::class, 'download'])->name('proforma.download');

    Route::get('change-password', [App\Http\Controllers\HomeController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('password.update'); 

    Route::match(['get', 'post'], '/search-item', [App\Http\Controllers\ItemController::class, 'searchitem'])->name('search-item');
    Route::match(['get', 'post'], '/search-client', [App\Http\Controllers\ClientController::class, 'searchclient'])->name('search-client');
    Route::match(['get', 'post'], '/search-proforma', [App\Http\Controllers\ProformaController::class, 'searchproforma'])->name('search-proforma');
    
});

Route::group(['middleware' => ['auth','role:administrator']], function() 
{
    // Only users with 'administrator' role can access these routes
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users.index');
    Route::match(['get', 'post'], '/search-user', [App\Http\Controllers\HomeController::class, 'searchuser'])->name('search-user');

    Route::get('/users/{id}/edit-password', [App\Http\Controllers\HomeController::class, 'editPassword'])->name('users.edit-password');
    Route::post('/users/{id}/update-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('users.update-password');

    Route::get('/users/create', [App\Http\Controllers\HomeController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\HomeController::class, 'store'])->name('users.store');

    Route::get('/users/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');    

});
