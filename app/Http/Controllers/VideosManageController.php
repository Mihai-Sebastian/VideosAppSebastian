<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Unit\VideosTest;

class VideosManageController extends Controller
{
    public function index()
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (auth()->user()->can('manage-videos')) {
            $videos = Video::all();
            return view('videos.manage.index', compact('videos'));
        }
        abort(403, 'Unauthorized');
    }

    public function create()
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (auth()->user()->can('manage-videos')) {
            return view('videos.manage.create');
        }
        abort(403, 'Unauthorized');
    }

    public function store(Request $request)
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        // Validar les dades
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        // Crear el vídeo amb l'usuari que el crea
        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo creat correctament.');
    }

    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $video = Video::findOrFail($id);
        return view('videos.manage.index', compact('video'));
    }

    public function edit($id)
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (auth()->user()->can('manage-videos')) {
            $video = Video::findOrFail($id);
            return view('videos.manage.edit', compact('video'));
        }
        abort(403, 'Unauthorized');
    }

    public function update(Request $request, $id)
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        // Validar las datos
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $video = Video::findOrFail($id);

        // Aquí verificamos si el usuario es el propietario o tiene el permiso 'manage-videos'
        if ($video->user_id !== auth()->id() && !auth()->user()->can('manage-videos')) {
            abort(403, 'No pots editar aquest vídeo.');
        }

        $video->update($request->all());

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo actualitzat correctament.');
    }

    public function delete($id)
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (auth()->user()->can('manage-videos')) {
            $video = Video::findOrFail($id);
            return view('videos.manage.delete', compact('video'));
        }
        abort(403, 'Unauthorized');
    }

    public function destroy($id)
    {
        // Verificar si el usuario tiene el permiso 'manage-videos'
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo eliminat correctament.');
    }

    public function testedBy()
    {
        return VideosTest::class;
    }
}
