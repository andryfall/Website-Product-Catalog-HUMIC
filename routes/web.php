<?php

use Illuminate\Support\Facades\Route;




Route::get('/profile', function () {
    return view('Profile');
});

Route::get('/settings', function () {
    return view('Settings');
});

use App\Http\Controllers\CatalogController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AuthController;

Route::post('/catalog/create', [CatalogController::class, 'createCatalog'])->name('catalog.create')->middleware(AdminMiddleware::class);

Route::get('/management', [CatalogController::class, 'index'])->name('catalogs.index')->middleware(AdminMiddleware::class);

Route::post('/catalog/update', [CatalogController::class, 'updateCatalog'])->name('catalog.update')->middleware(AdminMiddleware::class);

Route::post('/catalog/delete/{id}', [CatalogController::class, 'deleteCatalog'])->name('catalog.delete')->middleware(AdminMiddleware::class);

Route::get('/dashboard', [CatalogController::class, 'showActivity'])->name('catalogs.activity')->middleware(AdminMiddleware::class);


Route::get('/', action: [CatalogController::class, 'showCatalogs'])->name('catalogs.show');





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginAdmin'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/update-profile-image', [AuthController::class, 'updateProfileImage'])->name('update.profile');
Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('update.password');
Route::post('/update-admin', [AuthController::class, 'updateAdmin'])->name('update.admin');
