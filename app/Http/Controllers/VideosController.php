<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Unit\VideosTest;

class VideosController extends Controller
{
    public function show($id)
    {
        // Buscar el vídeo per ID
        $video = Video::find($id);

        // Si el vídeo no existeix, retornar error 404
        if (!$video) {
            return response()->json(['message' => 'Vídeo no trobat'], 404);
        }

        // Retornar la vista amb el vídeo
        return view('videos.show', compact('video'));
    }
    public function testedBy()
    {
        return VideosTest::class;
    }

}
