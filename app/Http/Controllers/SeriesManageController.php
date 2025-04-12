<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Unit\SerieTest;

class SeriesManageController extends Controller
{
    public function testedBy(): string
    {
        return SerieTest::class;
    }

    public function index()
    {
        if (!auth()->user()->can('manage-series')) abort(403);
        $series = Serie::paginate(10);
        return view('series.manage.index', compact('series'));
    }

    public function create()
    {
        if (!auth()->user()->can('manage-series')) abort(403);

        $videos = Video::all();

        return view('series.manage.create', compact('videos'));

    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('manage-series')) abort(403);

        // Validar la sol·licitud
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|url',
            'videos' => 'nullable|array', // En cas que es seleccionin vídeos
            'videos.*' => 'exists:videos,id', // Els vídeos seleccionats han de ser vàlids
        ]);

        // Crear la nova sèrie
        $serie = Serie::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'user_name' => auth()->user()->name, // Nom de l'usuari loguejat
            'user_photo_url' => auth()->user()->profile_photo_url, // Foto de l'usuari loguejat
            'published_at' => now(), // O una data personalitzada
        ]);

        // Si s'han seleccionat vídeos, associar-los a la nova sèrie
        if (!empty($validated['videos'])) {
            // Actualitzar els vídeos seleccionats per associar-los a la sèrie
            Video::whereIn('id', $validated['videos'])->update(['serie_id' => $serie->id]);
        }

        // Redirigir a la vista de gestió de sèries amb un missatge de confirmació
        return redirect()->route('series.manage.index')->with('success', 'Sèrie creada amb èxit!');
    }

    public function edit(Serie $serie)
    {
        if (!auth()->user()->can('manage-series')) abort(403);

        // Carregar tots els vídeos disponibles
        $videos = Video::all();

        // Recuperar els vídeos associats a la sèrie actual
        $selectedVideos = $serie->videos->pluck('id')->toArray();

        // Passar els vídeos i els vídeos seleccionats a la vista
        return view('series.manage.edit', compact('serie', 'videos', 'selectedVideos'));
    }

    public function update(Request $request, Serie $serie)
    {
        if (!auth()->user()->can('manage-series')) abort(403);

        // Validar la sol·licitud
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|url',
            'videos' => 'nullable|array', // En cas que es seleccionin vídeos
            'videos.*' => 'exists:videos,id', // Els vídeos seleccionats han de ser vàlids
        ]);

        // Actualitzar la sèrie
        $serie->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $validated['image'],
        ]);

        // Afegir nous vídeos seleccionats
        if (!empty($validated['videos'])) {
            // Assignar la sèrie als vídeos seleccionats
            Video::whereIn('id', $validated['videos'])->update(['serie_id' => $serie->id]);
        }

        // Redirigir a la vista de gestió de sèries amb un missatge de confirmació
        return redirect()->route('series.manage.index')->with('success', 'Sèrie actualitzada amb èxit!');
    }


    public function delete(Serie $serie)
    {
        if (!auth()->user()->can('manage-series')) abort(403);
        return view('series.manage.delete', compact('serie'));
    }

    public function destroy(Serie $serie)
    {

        if (!auth()->user()->can('manage-series')) abort(403);

        // Obtenim els vídeos associats a la sèrie
        $videos = Video::where('serie_id', $serie->id)->get();
        // Si el checkbox no està marcat, eliminem els vídeos també
        if (request()->input('remove_videos') == 0) {
            foreach ($videos as $video) {

                // Eliminar cada vídeo individualment
                // Eliminar vídeo directament sense cercar-lo de nou
                $video->delete();
            }
        } else {
            // Si està marcat, només desassignem els vídeos
            foreach ($videos as $video) {
                // Desassignar cada vídeo individualment
                $video->update(['serie_id' => null]);
            }
        }

        // Finalment, eliminem la sèrie
        $serie->delete();

        return redirect()->route('series.manage.index')->with('success', 'Sèrie eliminada correctament.');
    }





}
