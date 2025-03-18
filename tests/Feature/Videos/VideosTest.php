<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase; // Neteja la BD després de cada test

    /** @test */
    public function users_can_view_videos()
    {
        // Crear un usuari per assignar-lo al vídeo
        $user = \App\Models\User::factory()->create();

        // Crear un vídeo a la base de dades amb un `user_id`
        $video = Video::factory()->create([
            'title' => 'Prova de vídeo',
            'description' => 'Aquest és un vídeo de prova',
            'url' => 'https://www.youtube.com/watch?v=123456',
            'user_id' => $user->id,
        ]);

        // Fer una petició GET a la ruta del vídeo
        $response = $this->get(route('videos.show', $video->id));

        // Comprovar que la resposta és 200 (OK)
        $response->assertStatus(200);

        // Comprovar que el títol del vídeo es mostra a la vista
        $response->assertSee($video->title);
        $response->assertSee($video->description);
    }

    /** @test */
    public function users_cannot_view_not_existing_videos()
    {
        // Fer una petició GET a un vídeo que no existeix
        $response = $this->get(route('videos.show', 9999));

        // Comprovar que la resposta és 404 (No trobat)
        $response->assertStatus(404);
    }
}
