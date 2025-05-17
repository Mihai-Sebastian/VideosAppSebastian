<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Unit\VideosTest;

class VideosManageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->can('manage-videos')) {
            // Admins veuen tots els vídeos
            $videos = Video::all();
            return view('videos.manage.index', compact('videos'));
        }

        if ($user->can('create', Video::class) || Video::where('user_id', $user->id)->exists()) {
            // Si pot crear o té vídeos propis, el redirigim a la vista pública amb un avís
            return redirect()->route('videos.index')->with('info', 'Només pots gestionar els teus propis vídeos des de la pàgina principal.');
        }

        // Si no té cap permís, retornem un 403
        abort(403, 'No tens permís per accedir a la gestió de vídeos.');
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
        $video =  Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => auth()->id(),
        ]);

        event(new VideoCreated($video));

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
        $user = auth()->user();

        if ($user->id === $video->user_id || $user->can('manage-videos')) {
            return view('videos.manage.delete', compact('video'));
        }

        if ($user->can('create', Video::class)) {
            return redirect()->route('videos.index')->with('info', 'Només pots eliminar els teus propis vídeos.');
        }

        abort(403, 'No tens permís per eliminar aquest vídeo.');
    }



    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $user = auth()->user();

        if ($user->id === $video->user_id || $user->can('manage-videos')) {
            $video->delete();

            // Redirecció condicionada segons permisos
            if ($user->can('manage-videos')) {
                return redirect()->route('videos.manage.index')->with('success', 'Vídeo eliminat correctament.');
            } else {
                return redirect()->route('videos.index')->with('success', 'El teu vídeo s\'ha eliminat correctament.');
            }
        }

        if ($user->can('create', Video::class)) {
            return redirect()->route('videos.index')->with('info', 'Només pots eliminar els teus propis vídeos.');
        }

        abort(403, 'No tens permís per eliminar aquest vídeo.');
    }




    public function testedBy()
    {
        return VideosTest::class;
    }
}
