<?php

namespace Tests\Unit;

use App\Helpers\UserHelper;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test per verificar que un usuari és un superadmin.
     */
    public function test_is_super_admin()
    {
        $user = UserHelper::create_superadmin_user();
        $this->assertTrue($user->isSuperAdmin());

        $user = UserHelper::create_regular_user();
        $this->assertFalse($user->isSuperAdmin());
    }

    /**
     * Un usuari sense permisos pot veure la pàgina d'usuaris per defecte.
     */
    public function test_user_without_permissions_can_see_default_users_page()
    {
        $user = UserHelper::create_regular_user();

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
    }

    /**
     * Un usuari amb permisos pot veure la pàgina d'usuaris per defecte.
     */
    public function test_user_with_permissions_can_see_default_users_page()
    {
        $user = UserHelper::create_superadmin_user();

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
    }

    /**
     * Usuaris no autenticats no poden veure la pàgina d'usuaris per defecte.
     */
    public function test_not_logged_users_cannot_see_default_users_page()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Un usuari sense permisos pot veure la pàgina de detall d'un altre usuari.
     */
    public function test_user_without_permissions_can_see_user_show_page()
    {
        $user = UserHelper::create_regular_user();
        $otherUser = UserHelper::create_superadmin_user();

        $response = $this->actingAs($user)->get(route('users.show', $otherUser->id));

        $response->assertStatus(200);
    }

    /**
     * Un usuari amb permisos pot veure la pàgina de detall d'un altre usuari.
     */
    public function test_user_with_permissions_can_see_user_show_page()
    {
        $user = UserHelper::create_superadmin_user();
        $otherUser = UserHelper::create_regular_user();

        $response = $this->actingAs($user)->get(route('users.show', $otherUser->id));

        $response->assertStatus(200);
    }

    /**
     * Usuaris no autenticats no poden veure la pàgina de detall d'un usuari.
     */
    public function test_not_logged_users_cannot_see_user_show_page()
    {
        $user = UserHelper::create_regular_user();

        $response = $this->get(route('users.show', $user->id));

        $response->assertRedirect(route('login'));
    }
}
