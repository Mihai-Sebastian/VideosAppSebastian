<?php

namespace App\Helpers;
use App\Models\Video;
use Illuminate\Support\Carbon;
use App\Models\Serie;

class VideoHelper
{
    public static function createDefaultVideo()
    {
        // Creem les sèries primer
        $series1 = Serie::create([
            'title' => 'Laravel per Començants',
            'description' => 'Introducció a Laravel pas a pas.',
            'image' => 'https://picsum.photos/600/400?random=1',
            'user_name' => 'Admin',
            'user_photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'published_at' => now()->subDays(3),
        ]);

        $series2 = Serie::create([
            'title' => 'Vue.js Essentials',
            'description' => 'Tot el que necessites per començar amb Vue.',
            'image' => 'https://picsum.photos/600/400?random=2',
            'user_name' => 'Admin',
            'user_photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'published_at' => now()->subDays(2),
        ]);

        $series3 = Serie::create([
            'title' => 'Projectes Complets amb Laravel i Vue',
            'description' => 'Com unir Laravel i Vue per crear apps completes.',
            'image' => 'https://picsum.photos/600/400?random=3',
            'user_name' => 'Admin',
            'user_photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'published_at' => now()->subDay(),
        ]);

        // Creem els vídeos després de les sèries
        Video::create([
            'title' => 'Prova 1',
            'description' => 'Video de prova',
            'url' => 'https://www.youtube.com/embed/xiIDzCdOhmw?si=849tI9GK0X4P9V7E',
            'published_at' => Carbon::now(),
            'previous' => null,
            'next' => 2,
            'serie_id' => 1, // Assignem la sèrie correcta
            'user_id' => 1,
        ]);

        Video::create([
            'title' => 'Prova 2',
            'description' => 'Video de prova 2',
            'url' => 'https://www.youtube.com/embed/ApD5pR9bC-o?si=TDOHH_AswnGfsjB4',
            'published_at' => Carbon::now()->subDays(2),
            'previous' => 1,
            'next' => 3,
            'serie_id' => 2, // Assignem la sèrie correcta
            'user_id' => 1,
        ]);

        Video::create([
            'title' => 'Prova 3',
            'description' => 'Video de prova 3',
            'url' => 'https://www.youtube.com/embed/TJQgz1qKFVc?si=wPhIczbIEoaBnGBO',
            'published_at' => Carbon::now()->subDays(2),
            'previous' => 2,
            'next' => null,
            'serie_id' => 1, // Assignem la sèrie correcta
            'user_id' => 1,
        ]);
    }

    public static function createDefaultSeries()
    {
        // Creem les sèries per separat si vols gestionar-los de manera més estructurada
        Serie::create([
            'title' => 'Laravel per Començants',
            'description' => 'Introducció a Laravel pas a pas.',
            'image' => 'https://picsum.photos/600/400?random=1',
            'user_name' => 'Admin',
            'user_photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'published_at' => now()->subDays(3),
        ]);

        Serie::create([
            'title' => 'Vue.js Essentials',
            'description' => 'Tot el que necessites per començar amb Vue.',
            'image' => 'https://picsum.photos/600/400?random=2',
            'user_name' => 'Admin',
            'user_photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'published_at' => now()->subDays(2),
        ]);

        Serie::create([
            'title' => 'Projectes Complets amb Laravel i Vue',
            'description' => 'Com unir Laravel i Vue per crear apps completes.',
            'image' => 'https://picsum.photos/600/400?random=3',
            'user_name' => 'Admin',
            'user_photo_url' => 'https://ui-avatars.com/api/?name=Admin',
            'published_at' => now()->subDay(),
        ]);
    }
}
