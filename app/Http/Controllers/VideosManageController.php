<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Unit\VideosTest;

class VideosManageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si té permís, mostra tots els vídeos
        if ($user->can('manage-videos')) {
            $videos = Video::all();
        } else {
            // Si no té permís, només pot veure els seus propis
            $videos = Video::where('user_id', $user->id)->get();
        }

        return view('videos.manage.index', compact('videos'));
    }

    public function create()
    {
        // Qualsevol usuari autenticat pot crear vídeos
        return view('videos.manage.create');
    }

    public function store(Request $request)
    {
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
        $video = Video::findOrFail($id);

        // L'usuari pot editar si és propietari o té permisos
        if (auth()->id() !== $video->user_id && !auth()->user()->can('manage-videos')) {
            abort(403, 'No pots editar aquest vídeo.');
        }

        return view('videos.manage.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        if (auth()->id() !== $video->user_id && !auth()->user()->can('manage-videos')) {
            abort(403, 'No pots actualitzar aquest vídeo.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $video->update($request->only(['title', 'description', 'url']));

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo actualitzat correctament.');
    }

    public function delete($id)
    {
        $video = Video::findOrFail($id);

        if (auth()->id() !== $video->user_id && !auth()->user()->can('manage-videos')) {
            abort(403, 'No pots eliminar aquest vídeo.');
        }

        return view('videos.manage.delete', compact('video'));
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if (auth()->id() !== $video->user_id && !auth()->user()->can('manage-videos')) {
            abort(403, 'No pots eliminar aquest vídeo.');
        }

        $video->delete();

        return redirect()->route('videos.manage.index')->with('success', 'Vídeo eliminat correctament.');
    }


    public function testedBy()
    {
        return VideosTest::class;
    }
}
