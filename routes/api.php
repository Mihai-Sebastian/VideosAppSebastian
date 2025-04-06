<?php

use App\Http\Controllers\ApiMultimediaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware([EnsureFrontendRequestsAreStateful::class])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    // Crear un nou vídeo
    Route::post('/multimedia', [ApiMultimediaController::class, 'store']);

    // Obtenir els vídeos de l'usuari autenticat
    Route::get('/multimedia', [ApiMultimediaController::class, 'index']);

    // Ruta per editar la informació d'un vídeo
    Route::get('/multimedia/edit/{id}', [ApiMultimediaController::class, 'show']);
    Route::put('/multimedia/edit', [ApiMultimediaController::class, 'update']);
    // Eliminar un vídeo de l'usuari autenticat
    Route::delete('/multimedia/{id}', [ApiMultimediaController::class, 'destroy']);
});


Route::get('/multimedia/all', [ApiMultimediaController::class, 'all']);

Route::get('multimedia/{id}/related', [ApiMultimediaController::class, 'showWithRelated']);


