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
        $user = auth()->user();

        // Si té permís, veu tots els vídeos
        if ($user->can('manage-series')) {
            $videos = Video::all();
        } else {
            // Si no té permís, només veu els seus
            $videos = Video::where('user_id', $user->id)->get();
        }

        return view('series.manage.create', compact('videos'));
    }


    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|url',
            'videos' => 'nullable|array',
            'videos.*' => 'exists:videos,id',
        ]);

        // Crear la sèrie
        $serie = Serie::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_photo_url' => $user->profile_photo_url,
            'published_at' => now(),
        ]);

        $videoIds = $validated['videos'] ?? [];

        // Si no és admin, només pot afegir els seus vídeos
        if (! $user->can('manage-series')) {
            foreach ($videoIds as $videoId) {
                $video = Video::find($videoId);
                if ($video->user_id !== $user->id) {
                    abort(403, 'Intent d’afegir un vídeo que no és teu.');
                }
            }
        }

        // Assignar vídeos
        Video::whereIn('id', $videoIds)->update(['serie_id' => $serie->id]);

        // Redirigir segons permís
        if ($user->can('manage-series')) {
            return redirect()->route('series.manage.index')->with('success', 'Sèrie creada correctament.');
        }

        return redirect()->route('series.index')->with('success', 'Sèrie creada correctament.');

    }


    public function edit(Serie $serie)
    {
        $user = auth()->user();

        if (! $user->can('manage-series') && $user->id !== $serie->user_id) {
            abort(403, 'No tens permís per editar aquesta sèrie.');
        }

        $videos = $user->can('manage-series')
            ? Video::all()
            : Video::where('user_id', $user->id)->get();

        $selectedVideos = $serie->videos->pluck('id')->toArray();

        return view('series.manage.edit', compact('serie', 'videos', 'selectedVideos'));
    }

    public function update(Request $request, Serie $serie)
    {
        $user = auth()->user();

        if (! $user->can('manage-series') && $user->id !== $serie->user_id) {
            abort(403, 'No tens permís per actualitzar aquesta sèrie.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|url',
            'videos' => 'nullable|array',
            'videos.*' => 'exists:videos,id',
        ]);

        $serie->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
        ]);

        $videoIds = $validated['videos'] ?? [];

        if (! $user->can('manage-series')) {
            foreach ($videoIds as $videoId) {
                $video = Video::find($videoId);
                if ($video->user_id !== $user->id) {
                    abort(403, 'No pots afegir vídeos que no són teus.');
                }
            }
        }

        Video::whereIn('id', $videoIds)->update(['serie_id' => $serie->id]);

        $redirect = $user->can('manage-series')
            ? route('series.manage.index')
            : route('series.show', $serie->id);

        return redirect($redirect)->with('success', 'Sèrie actualitzada correctament.');
    }


    public function delete(Serie $serie)
    {
        $user = auth()->user();

        if (! $user->can('manage-series') && $user->id !== $serie->user_id) {
            abort(403, 'No tens permís per eliminar aquesta sèrie.');
        }

        return view('series.manage.delete', compact('serie'));
    }

    public function destroy(Serie $serie)
    {
        $user = auth()->user();

        if (! $user->can('manage-series') && $user->id !== $serie->user_id) {
            abort(403, 'No tens permís per eliminar aquesta sèrie.');
        }

        $videos = $serie->videos;

        if (request()->input('remove_videos') == 0) {
            foreach ($videos as $video) {
                $video->delete();
            }
        } else {
            foreach ($videos as $video) {
                $video->update(['serie_id' => null]);
            }
        }

        $serie->delete();

        $redirect = $user->can('manage-series')
            ? route('series.manage.index')
            : route('series.index');

        return redirect($redirect)->with('success', 'Sèrie eliminada correctament.');
    }






}
