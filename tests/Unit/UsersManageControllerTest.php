<?php

namespace Tests\Feature;

use App\Helpers\UserHelper;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        UserHelper::create_permissions();
    }

    private function loginAsVideoManager()
    {
        $user = UserHelper::create_video_manager_user();
        $this->actingAs($user);
        return $user;
    }

    private function loginAsSuperAdmin()
    {
        $user = UserHelper::create_superadmin_user();
        $this->actingAs($user);
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = UserHelper::create_regular_user();
        $this->actingAs($user);
        return $user;
    }
    private function createRoles()
    {
        $roles = ['super_admin', 'regular_user', 'video_manager'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
    public function test_user_with_permissions_can_see_add_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.manage.create'));
        $response->assertStatus(200);
    }

    public function test_user_without_users_manage_create_cannot_see_add_users()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('users.manage.create'));
        $response->assertStatus(403);
        $this->loginAsVideoManager();
        $response = $this->get(route('users.manage.create'));
        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_store_users()
    {
        $this->createRoles();

        $this->loginAsSuperAdmin();
        $response = $this->post(route('users.manage.store'), [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'super_admin',
        ]);
        $response->assertRedirect(route('users.manage.index'));
        $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);
    }

    public function test_user_without_permissions_cannot_store_users()
    {
        $this->loginAsRegularUser();
        $response = $this->post(route('users.manage.store'), [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'regular_user',
        ]);
        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_destroy_users()
    {
        $this->loginAsSuperAdmin();
        $user = UserHelper::create_regular_user();
        $response = $this->delete(route('users.manage.destroy', $user->id));
        $response->assertRedirect(route('users.manage.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_user_without_permissions_cannot_destroy_users()
    {
        $this->loginAsRegularUser();
        $user = UserHelper::create_superadmin_user();
        $response = $this->delete(route('users.manage.destroy', $user->id));
        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_see_edit_users()
    {
        $this->loginAsSuperAdmin();
        $user = UserHelper::create_regular_user();
        $response = $this->get(route('users.manage.edit', $user->id));
        $response->assertStatus(200);
    }

    public function test_user_without_permissions_cannot_see_edit_users()
    {
        $this->loginAsRegularUser();
        $user = UserHelper::create_superadmin_user();
        $response = $this->get(route('users.manage.edit', $user->id));
        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_update_users()
    {
        $this->createRoles();
        $this->loginAsSuperAdmin();
        $user = UserHelper::create_regular_user();
        $response = $this->put(route('users.manage.update', $user->id), [
            'name' => 'Updated Name',
            'email' => $user->email,
            'role' => 'regular_user',
        ]);
        $response->assertRedirect(route('users.manage.index'));
        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    public function test_user_without_permissions_cannot_update_users()
    {
        $this->loginAsRegularUser();
        $user = UserHelper::create_superadmin_user();
        $response = $this->put(route('users.manage.update', $user->id), [
            'name' => 'Updated Name',
            'email' => $user->email,
        ]);
        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_manage_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.manage.index'));
        $response->assertStatus(200);
    }

    public function test_regular_users_cannot_manage_users()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('users.manage.index'));
        $response->assertStatus(403);
    }

    public function test_guest_users_cannot_manage_users()
    {
        $response = $this->get(route('users.manage.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_superadmins_can_manage_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.manage.index'));
        $response->assertStatus(200);
    }
}
