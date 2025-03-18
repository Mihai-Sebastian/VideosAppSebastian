<?php

namespace Tests\Unit;

use App\Helpers\UserHelper;
use Tests\TestCase;
use App\Models\Video;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class VideosTest extends TestCase
{
    use RefreshDatabase; // Reinicia la base de dades abans de cada test

    protected function setUp(): void
    {
        parent::setUp();

        // Netejar la caché de permisos per evitar problemes
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        Permission::firstOrCreate(['name' => 'manage-videos']);

        // Crear rols i assignar permisos
        $regularUserRole = Role::firstOrCreate(['name' => 'regular_user']);
        $videoManagerRole = Role::firstOrCreate(['name' => 'video_manager']);

        $videoManagerRole->givePermissionTo('manage-videos');
    }

    /** @test */
    public function can_get_formatted_published_at_date()
    {
        // Creem un vídeo amb una data publicada específica
        UserHelper::create_regular_user();
        $video = Video::create([
            'title' => 'Vídeo de prova',
            'description' => 'Aquest és un vídeo de prova',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => Carbon::create(2024, 1, 21, 12, 0, 0), // 21 de gener de 2024
            'user_id' => 1,
        ]);

        // Esperem que la data formatada sigui "21 de gener de 2024"
        $this->assertEquals('21 de gener de 2024', $video->formatted_published_at);
    }

    /** @test */
    public function can_get_formatted_published_at_date_when_not_published()
    {
        UserHelper::create_regular_user();
        // Creem un vídeo sense la data de publicació
        $video = Video::create([
            'title' => 'Vídeo sense publicar',
            'description' => 'Aquest vídeo encara no està publicat',
            'url' => 'https://www.youtube.com/watch?v=example2',
            'published_at' => null,
            'user_id' => 1,
        ]);

        // Esperem que si no hi ha data de publicació, el mètode retorni "No publicat"
        $this->assertEquals('No publicat', $video->formatted_published_at);
    }

    /** @test */
    public function user_without_permissions_can_see_default_videos_page()
    {
        $user = User::factory()->create();
        $user->assignRole('regular_user');

        $response = $this->actingAs($user)->get(route('videos.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function user_with_permissions_can_see_default_videos_page()
    {
        $user = User::factory()->create();
        $user->assignRole('video_manager');

        $response = $this->actingAs($user)->get(route('videos.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function not_logged_users_can_see_default_videos_page()
    {
        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
    }
}
