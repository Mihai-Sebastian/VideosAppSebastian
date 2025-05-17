<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Models\Video;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function serie_have_videos()
    {
        // Creem un usuari manualment
        $user = \App\Models\User::create([
            'name' => 'Usuari de prova',
            'email' => 'prova@exemple.com',
            'password' => bcrypt('password'),
        ]);

        // Creem una sèrie manualment
        $serie = Serie::create([
            'title' => 'Sèrie de prova',
            'description' => 'Descripció de prova',
            'user_id' => $user->id,
            'user_name' => 'Prova Usuari',
        ]);

        // Afegim vídeos associats a la sèrie
        $video1 = Video::create([
            'title' => 'Vídeo 1',
            'description' => 'Descripció 1',
            'url' => 'https://example.com/1',
            'serie_id' => $serie->id,
            'user_id' => $user->id,
        ]);

        $video2 = Video::create([
            'title' => 'Vídeo 2',
            'description' => 'Descripció 2',
            'url' => 'https://example.com/2',
            'serie_id' => $serie->id,
            'user_id' => $user->id,
        ]);

        $video3 = Video::create([
            'title' => 'Vídeo 3',
            'description' => 'Descripció 3',
            'url' => 'https://example.com/3',
            'serie_id' => $serie->id,
            'user_id' => $user->id,
        ]);

        // Comprovem que els vídeos tenen el correcte 'serie_id'
        $this->assertEquals($serie->id, $video1->serie_id);
        $this->assertEquals($serie->id, $video2->serie_id);
        $this->assertEquals($serie->id, $video3->serie_id);
    }
}
