<?php

use App\Http\Controllers\ApiMultimediaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return redirect()->route('videos.index');
});

Route::get('/notificacions', function () {
    $notifications = auth()->user()->notifications()->latest()->get();

    return view('notifications.index', compact('notifications'));
})->middleware('auth');

// Middleware per autenticació amb Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('videos.index');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('series/manage')->name('series.manage.')->group(function () {
        Route::get('/', [SeriesManageController::class, 'index'])->name('index'); // Llistar sèries
        Route::get('create', [SeriesManageController::class, 'create'])->name('create'); // Crear sèrie
        Route::post('store', [SeriesManageController::class, 'store'])->name('store'); // Desa nova sèrie
         Route::get('edit/{serie}', [SeriesManageController::class, 'edit'])->name('edit'); // Editar sèrie
        Route::put('update/{serie}', [SeriesManageController::class, 'update'])->name('update'); // Actualitzar sèrie
        Route::get('delete/{serie}', [SeriesManageController::class, 'delete'])->name('delete'); // Confirmar eliminar sèrie
        Route::delete('destroy/{serie}', [SeriesManageController::class, 'destroy'])->name('destroy'); // Eliminar sèrie
    });

    Route::prefix('series')->name('series.')->group(function () {
        Route::get('/', [SeriesController::class, 'index'])->name('index'); // Mostrar totes les sèries
        Route::get('{serie}', [SeriesController::class, 'show'])->name('show'); // Mostrar els vídeos d'una sèrie
    });
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

Route::middleware(['auth'])->group(function () {
    Route::get('/users/manage', [UsersManageController::class, 'index'])->name('users.manage.index');
    Route::get('/users/manage/create', [UsersManageController::class, 'create'])->name('users.manage.create');
    Route::post('/users/manage', [UsersManageController::class, 'store'])->name('users.manage.store');
    Route::get('/users/manage/{user}/edit', [UsersManageController::class, 'edit'])->name('users.manage.edit');
    Route::put('/users/manage/{user}', [UsersManageController::class, 'update'])->name('users.manage.update');
    Route::get('/users/manage/{user}/delete', [UsersManageController::class, 'delete'])->name('users.manage.delete');
    Route::delete('/users/manage/{user}', [UsersManageController::class, 'destroy'])->name('users.manage.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
});



// Ruta per veure tots els vídeos (estil pàgina de YouTube)
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

// Ruta per veure un vídeo concret
Route::get('/videos/{video}', [VideosController::class, 'show'])->name('videos.show');
