<?php

use App\Http\Controllers\SetupController;
use Illuminate\Support\Facades\Route;

Route::prefix('setup')->name('setup.')->group(function () {
    Route::get('/', [SetupController::class, 'welcome'])->name('welcome');
    Route::get('/database', [SetupController::class, 'database'])->name('database');
    Route::post('/database', [SetupController::class, 'saveDatabase'])->name('database.save');
    Route::get('/migrations', [SetupController::class, 'migrations'])->name('migrations');
    Route::post('/migrations', [SetupController::class, 'runMigrations'])->name('migrations.run');
    Route::get('/admin', [SetupController::class, 'admin'])->name('admin');
    Route::post('/admin', [SetupController::class, 'saveAdmin'])->name('admin.save');
    Route::get('/complete', [SetupController::class, 'complete'])->name('complete');
});
