<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Unit\VideosTest;

class VideosController extends Controller
{
    public function show($id)
    {
        $video = Video::findOrFail($id);

        $previous = Video::where('id', '<', $video->id)->orderBy('id', 'desc')->first();

        $next = Video::where('id', '>', $video->id)->orderBy('id', 'asc')->first();

        return view('videos.show', compact('video', 'previous', 'next'));
    }

    public function testedBy()
    {
        return VideosTest::class;
    }
    public function index()
    {
        $videos = Video::paginate(3);
        return view('videos.index', compact('videos'));
    }


}
