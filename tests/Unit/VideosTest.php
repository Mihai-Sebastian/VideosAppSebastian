<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class VideosTest extends TestCase
{
    use RefreshDatabase; // Reinicia la base de dades abans de cada test

    /** @test */
    public function can_get_formatted_published_at_date()
    {
        // Creem un vídeo amb una data publicada específica
        $video = Video::create([
            'title' => 'Vídeo de prova',
            'description' => 'Aquest és un vídeo de prova',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => Carbon::create(2024, 1, 21, 12, 0, 0), // 21 de gener de 2024
        ]);

        // Esperem que la data formatada sigui "21 de gener de 2024"
        $this->assertEquals('21 de gener de 2024', $video->formatted_published_at);
    }

    /** @test */
    public function can_get_formatted_published_at_date_when_not_published()
    {
        // Creem un vídeo sense la data de publicació
        $video = Video::create([
            'title' => 'Vídeo sense publicar',
            'description' => 'Aquest vídeo encara no està publicat',
            'url' => 'https://www.youtube.com/watch?v=example2',
            'published_at' => null,
        ]);

        // Esperem que si no hi ha data de publicació, el mètode retorni "No publicat"
        $this->assertEquals('No publicat', $video->formatted_published_at);
    }
}
