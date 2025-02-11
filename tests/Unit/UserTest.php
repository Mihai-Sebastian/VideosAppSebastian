<?php

namespace Tests\Unit;

use App\Helpers\UserHelper;
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
        // Crear un usuari superadmin amb el UserHelper
        $user = UserHelper::create_superadmin_user();

        // Verificar que la funció isSuperAdmin retorna true per un superadmin
        $this->assertTrue($user->isSuperAdmin());

        $user = UserHelper::create_regular_user();
        $this->assertFalse($user->isSuperAdmin());
    }
}
