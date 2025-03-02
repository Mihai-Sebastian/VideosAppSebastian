<?php

use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Middleware per autenticació amb Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutes per la gestió de vídeos (només per usuaris autenticats i amb permisos)
Route::middleware(['auth'])->group(function () {
    Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.manage.index');
    Route::get('/videos/manage/create', [VideosManageController::class, 'create'])->name('videos.manage.create');
    Route::post('/videos/manage', [VideosManageController::class, 'store'])->name('videos.manage.store');
    Route::get('/videos/manage/{video}/edit', [VideosManageController::class, 'edit'])->name('videos.manage.edit');
    Route::put('/videos/manage/{video}', [VideosManageController::class, 'update'])->name('videos.manage.update');
    Route::get('/videos/manage/{video}/delete', [VideosManageController::class, 'delete'])->name('videos.manage.delete');
    Route::delete('/videos/manage/{video}', [VideosManageController::class, 'destroy'])->name('videos.manage.destroy');
});

// Ruta per veure tots els vídeos (estil pàgina de YouTube)
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

// Ruta per veure un vídeo concret
Route::get('/videos/{video}', [VideosController::class, 'show'])->name('videos.show');
