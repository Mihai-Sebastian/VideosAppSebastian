<?php

namespace App\Helpers;
use App\Models\Video;
use Illuminate\Support\Carbon;

class VideoHelper
{
    public static function createDefaultVideo()
    {
        Video::create([
            'title' => 'Prova 1',
            'description' => 'Video de prova',
            'url' => 'https://www.youtube.com/embed/xiIDzCdOhmw?si=849tI9GK0X4P9V7E',
            'published_at' => Carbon::now(),
            'previous' => null,
            'next' => 2,
            'series_id' => 1,
        ]);

        Video::create([
            'title' => 'Prova 2',
            'description' => 'Video de prova 2',
            'url' => 'https://www.youtube.com/embed/ApD5pR9bC-o?si=TDOHH_AswnGfsjB4',
            'published_at' => Carbon::now()->subDays(2),
            'previous' => 1,
            'next' => 3,
            'series_id' => 1,
        ]);
        Video::create([
            'title' => 'Prova 3',
            'description' => 'Video de prova 3',
            'url' => 'https://www.youtube.com/embed/TJQgz1qKFVc?si=wPhIczbIEoaBnGBO',
            'published_at' => Carbon::now()->subDays(2),
            'previous' => 2,
            'next' => null,
            'series_id' => 1,
        ]);
    }
}
