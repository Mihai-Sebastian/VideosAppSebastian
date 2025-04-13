<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeriesManageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Crear permisos i rols
        Permission::create(['name' => 'manage-series']);

        Role::create(['name' => 'regular_user']);
        Role::create(['name' => 'video_manager'])->givePermissionTo('manage-series');
        Role::create(['name' => 'super_admin'])->givePermissionTo('manage-series');
    }

    private function loginAsVideoManager(): User
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'vm@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('video_manager');
        return $user;
    }

    private function loginAsSuperAdmin(): User
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('super_admin');
        return $user;
    }

    private function loginAsRegularUser(): User
    {
        $user = User::create([
            'name' => 'Usuari Regular',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('regular_user');
        return $user;
    }

    private function createSerie($user): Serie
    {
        return Serie::create([
            'title' => 'Sèrie Test',
            'description' => 'Descripció test',
            'image' => 'https://picsum.photos/600/400?random=1',
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }

    /** @test */
    public function user_with_permissions_can_see_add_series()
    {
        $user = $this->loginAsVideoManager();
        $response = $this->actingAs($user)->get('/series/manage/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_without_series_manage_create_cannot_see_add_series()
    {
        $user = $this->loginAsRegularUser();
        $response = $this->actingAs($user)->get('/series/manage/create');
        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_store_series()
    {
        $user = $this->loginAsVideoManager();
        $response = $this->actingAs($user)->post('/series/manage/store', [
            'title' => 'Nova sèrie',
            'description' => 'Descripció nova',
            'image' => 'https://example.com/image.jpg',
            'user_name' => $user->name,
        ]);
        $response->assertRedirect('/series/manage');
        $this->assertDatabaseHas('series', ['title' => 'Nova sèrie']);
    }

    /** @test */
    public function user_without_permissions_cannot_store_series()
    {
        $user = $this->loginAsRegularUser();
        $response = $this->actingAs($user)->post('/series/manage/store', [
            'title' => 'Nova sèrie',
            'description' => 'Descripció nova',
            'image' => 'https://example.com/image.jpg',
        ]);
        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_destroy_series()
    {
        $user = $this->loginAsVideoManager();
        $serie = $this->createSerie($user);
        $response = $this->actingAs($user)->delete("/series/manage/destroy/{$serie->id}");
        $response->assertRedirect('/series/manage');
        $this->assertDatabaseMissing('series', ['id' => $serie->id]);
    }

    /** @test */
    public function user_without_permissions_cannot_destroy_series()
    {
        $owner = $this->loginAsVideoManager();
        $serie = $this->createSerie($owner);

        $user = $this->loginAsRegularUser();
        $response = $this->actingAs($user)->delete("/series/manage/destroy({$serie->id}");
        $response->assertStatus(404);
        $this->assertDatabaseHas('series', ['id' => $serie->id]);
    }

    /** @test */
    public function user_with_permissions_can_see_edit_series()
    {
        $user = $this->loginAsVideoManager();
        $serie = $this->createSerie($user);
        $response = $this->actingAs($user)->get("/series/manage/edit/{$serie->id}");
        $response->assertStatus(200);
    }

    /** @test */
    public function user_without_permissions_cannot_see_edit_series()
    {
        $owner = $this->loginAsVideoManager();
        $serie = $this->createSerie($owner);

        $user = $this->loginAsRegularUser();
        $response = $this->actingAs($user)->get("/series/manage/edit/{$serie->id}");
        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_update_series()
    {
        $user = $this->loginAsVideoManager();
        $serie = $this->createSerie($user);
        $response = $this->actingAs($user)->put("/series/manage/update/{$serie->id}", [
            'title' => 'Sèrie editada',
            'description' => 'Nova descripció',
            'image' => 'https://example.com/new.jpg',
        ]);
        $response->assertRedirect('/series/manage');
        $this->assertDatabaseHas('series', ['id' => $serie->id, 'title' => 'Sèrie editada']);
    }

    /** @test */
    public function user_without_permissions_cannot_update_series()
    {
        $owner = $this->loginAsVideoManager();
        $serie = $this->createSerie($owner);

        $user = $this->loginAsRegularUser();
        $response = $this->actingAs($user)->put("/series/manage/update/{$serie->id}", [
            'title' => 'Intent',
            'description' => 'Maliciós',
            'image' => 'https://malicios.com/fake.jpg',
        ]);
        $response->assertStatus(403);
        $this->assertDatabaseMissing('series', ['title' => 'Intent']);
    }

    /** @test */
    public function user_with_permissions_can_manage_series()
    {
        $user = $this->loginAsVideoManager();
        $response = $this->actingAs($user)->get('/series/manage');
        $response->assertStatus(200);
    }

    /** @test */
    public function regular_users_cannot_manage_series()
    {
        $user = $this->loginAsRegularUser();
        $response = $this->actingAs($user)->get('/series/manage');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_series()
    {
        $response = $this->get('/series/manage');
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function videomanagers_can_manage_series()
    {
        $user = $this->loginAsVideoManager();
        $response = $this->actingAs($user)->get('/series/manage');
        $response->assertStatus(200);
    }

    /** @test */
    public function superadmins_can_manage_series()
    {
        $user = $this->loginAsSuperAdmin();
        $response = $this->actingAs($user)->get('/series/manage');
        $response->assertStatus(200);
    }
}
