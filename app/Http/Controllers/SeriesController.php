<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $series = Serie::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(10);

        return view('series.index', compact('series'));
    }


    public function show(Serie $serie)
    {
        // Paginació dels vídeos de la sèrie (3 vídeos per pàgina)
        $videos = $serie->videos()->latest('published_at')->paginate(3); // 3 vídeos per pàgina

        return view('series.show', compact('serie', 'videos'));
    }


}
