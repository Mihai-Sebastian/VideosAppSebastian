<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Unit\VideosTest;

class VideosManageController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('manage-videos')) {
            $videos = Video::all();
            return view('videos.manage.index', compact('videos'));
        }
        abort(403, 'Unauthorized');
    }

    public function create()
    {
        if (auth()->user()->can('manage-videos')) {
            return view('videos.manage.create');
        }
        abort(403, 'Unauthorized');
    }

    public function store(Request $request)
    {
        // Verificar permisos amb can
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        // Validar les dades
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        // Crear el vídeo amb la data de creació
        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo creat correctament.');
    }



    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.manage.show', compact('video'));
    }

    public function edit($id)
    {
        if (auth()->user()->can('manage-videos')) {
            $video = Video::findOrFail($id);
            return view('videos.manage.edit', compact('video'));
        }
        abort(403, 'Unauthorized');
    }

    public function update(Request $request, $id)
    {
        // Verificar permisos amb can
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        // Validar les dades
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $video = Video::findOrFail($id);
        $video->update($request->all());

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo actualitzat correctament.');
    }

    public function delete($id)
    {
        if (auth()->user()->can('manage-videos')) {
            $video = Video::findOrFail($id);
            return view('videos.manage.delete', compact('video'));
        }
        abort(403, 'Unauthorized');
    }

    public function destroy($id)
    {
        // Verificar permisos amb can
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo eliminat correctament.');
    }

    public function testedBy()
    {
        return VideosTest::class; // Esta línea puede ser removida si no es necesaria
    }
}
