<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function test_user_with_permissions_can_manage_videos()
    {
        // Creem 3 vídeos manualment
        $videos = \App\Models\Video::create([
            'title' => 'Video 1',
            'url' => 'https://www.youtube.com/watch?v=video1',
            'description' => 'Descripció del vídeo 1',
            'user_id' => 1
        ]);

        $videos = \App\Models\Video::create([
            'title' => 'Video 2',
            'url' => 'https://www.youtube.com/watch?v=video2',
            'description' => 'Descripció del vídeo 2',
            'user_id' => 1
        ]);

        $videos = \App\Models\Video::create([
            'title' => 'Video 3',
            'url' => 'https://www.youtube.com/watch?v=video3',
            'description' => 'Descripció del vídeo 3',
            'user_id' => 1

        ]);

        // Loguem l'usuari com a Video Manager
        $videoManager = $this->loginAsVideoManager();

        // Realitzem la petició a la ruta '/videos/manage'
        $response = $this->actingAs($videoManager)->get('/videos/manage');

        // Comprovem que la resposta sigui correcta
        $response->assertStatus(200);

        // Comprovem que els 3 vídeos es mostren en la vista (si és necessari, segons com estigui implementada la vista)
        $response->assertSee('Video 1');
        $response->assertSee('Video 2');
        $response->assertSee('Video 3');
    }

//    public function test_user_without_videos_manage_create_cannot_see_add_videos()
//    {
//        // Loguem un usuari regular (sense permisos per gestionar vídeos)
//        $regularUser = $this->loginAsRegularUser();
//
//        // Intentem accedir a la pàgina per crear un vídeo
//        $response = $this->actingAs($regularUser)->get('/videos/manage/create');
//
//        // Comprovem que l'usuari no pot veure la pàgina i rep un error 403
//        $response->assertStatus(403);
//    }
    /** @test */
//    public function test_regular_users_cannot_manage_videos()
//    {
//        $regularUser = $this->loginAsRegularUser();
//        $response = $this->actingAs($regularUser)->get('/videos/manage');
//        $response->assertStatus(403);
//    }

    /** @test */
    public function test_guest_users_cannot_manage_videos()
    {
        $response = $this->get('/videos/manage');
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_superadmins_can_manage_videos()
    {
        $superAdmin = $this->loginAsSuperAdmin();
        $response = $this->actingAs($superAdmin)->get('/videos/manage');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_user_with_permissions_can_see_add_videos()
    {
        $videoManager = $this->loginAsVideoManager();
        $response = $this->actingAs($videoManager)->get('/videos/manage/create');
        $response->assertStatus(200);
    }

    /** @test */
//    public function test_user_without_permissions_cannot_see_add_videos()
//    {
//        $regularUser = $this->loginAsRegularUser();
//        $response = $this->actingAs($regularUser)->get('/videos/manage/create');
//        $response->assertStatus(403);
//    }

    /** @test */
    public function test_user_with_permissions_can_store_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        $videoData = [
            'title' => 'Test Video',
            'description' => 'Test description',
            'url' => 'http://example.com/test-video'
        ];

        $response = $this->actingAs($videoManager)->post('/videos/manage', $videoData);
        $response->assertRedirect('/videos/manage');
        $this->assertDatabaseHas('videos', ['title' => 'Test Video']);
    }

    /** @test */
//    public function test_user_without_permissions_cannot_store_videos()
//    {
//        $regularUser = $this->loginAsRegularUser();
//
//        // Accés a create
//        $response = $this->actingAs($regularUser)->get('/videos/manage/create');
//        $response->assertStatus(403); // Canviat de 302 a 403
//
//        // POST request
//        $videoData = [
//            'title' => 'Test Video',
//            'description' => 'Test description',
//            'url' => 'http://example.com/test-video',
//            'user_id' => 1
//
//        ];
//
//        $response = $this->actingAs($regularUser)->post('/videos/manage', $videoData);
//        $response->assertStatus(403); // Canviat de 302 a 403
//        $this->assertDatabaseMissing('videos', ['title' => 'Test Video']);
//    }

    /** @test */
    public function test_user_with_permissions_can_destroy_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        // Creació completa del vídeo
        $video = Video::factory()->create([
            'title' => 'Test Video',
            'description' => 'Test description',
            'url' => 'http://example.com/test-video',
            'user_id' => 1
        ]);

        $response = $this->actingAs($videoManager)->delete('/videos/manage/' . $video->id);
        $response->assertRedirect('/videos/manage');
        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    /** @test */
//    public function test_user_without_permissions_cannot_destroy_videos()
//    {
//        $regularUser = $this->loginAsRegularUser();
//
//        // Creació completa del vídeo
//        $video = Video::factory()->create([
//            'title' => 'Test Video',
//            'description' => 'Test description',
//            'url' => 'http://example.com/test-video',
//            'user_id' => 1
//
//        ]);
//
//        $response = $this->actingAs($regularUser)->delete('/videos/manage/' . $video->id);
//        $response->assertStatus(403);
//        $this->assertDatabaseHas('videos', ['id' => $video->id]);
//    }

    /** @test */
    public function test_user_with_permissions_can_see_edit_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        // Creació completa del vídeo
        $video = Video::factory()->create([
            'title' => 'Test Video',
            'description' => 'Test description',
            'url' => 'http://example.com/test-video',
            'user_id' => 1
        ]);

        $response = $this->actingAs($videoManager)->get('/videos/manage/' . $video->id . '/edit');
        $response->assertStatus(200);
    }

    /** @test */
//    public function test_user_without_permissions_cannot_see_edit_videos()
//    {
//        $regularUser = $this->loginAsRegularUser();
//
//        // Creació completa del vídeo
//        $video = Video::factory()->create([
//            'title' => 'Test Video',
//            'description' => 'Test description',
//            'url' => 'http://example.com/test-video',
//            'user_id' => 1
//        ]);
//
//        $response = $this->actingAs($regularUser)->get('/videos/manage/' . $video->id . '/edit');
//        $response->assertStatus(403);
//    }

    /** @test */
    public function test_user_with_permissions_can_update_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        // Creació completa del vídeo
        $video = Video::factory()->create([
            'title' => 'Test Video',
            'description' => 'Test description',
            'url' => 'http://example.com/test-video',
            'user_id' => 1
        ]);

        $videoData = [
            'title' => 'Updated Title',
            'description' => 'Updated description',
            'url' => 'http://example.com/updated',
            'user_id' => 1

        ];

        $response = $this->actingAs($videoManager)->put('/videos/manage/' . $video->id, $videoData);
        $response->assertRedirect('/videos/manage');
        $this->assertDatabaseHas('videos', ['id' => $video->id, 'title' => 'Updated Title']);
    }

    /** @test */
//    public function test_user_without_permissions_cannot_update_videos()
//    {
//        $regularUser = $this->loginAsRegularUser();
//
//        // Creació completa del vídeo
//        $video = Video::factory()->create([
//            'title' => 'Test Video',
//            'description' => 'Test description',
//            'url' => 'http://example.com/test-video',
//            'user_id' => 1
//        ]);
//
//        $videoData = [
//            'title' => 'Updated Title',
//            'description' => 'Updated description',
//            'url' => 'http://example.com/updated' ,
//            'user_id' => 1
//
//        ];
//
//        $response = $this->actingAs($regularUser)->put('/videos/manage/' . $video->id, $videoData);
//        $response->assertStatus(403);
//        $this->assertDatabaseMissing('videos', ['title' => 'Updated Title']);
//    }

    // Funcions auxiliars
    private function loginAsVideoManager(): User
    {
        return User::where('email', 'videosmanager@videosapp.com')->firstOrFail();
    }

    private function loginAsSuperAdmin(): User
    {
        return User::where('email', 'superadmin@videosapp.com')->firstOrFail();
    }

    private function loginAsRegularUser(): User
    {
        return User::where('email', 'regular@videosapp.com')->firstOrFail();
    }
}
