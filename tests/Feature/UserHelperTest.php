<?php

namespace Tests\Feature;

use App\Helpers\UserHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UserHelperTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateDefaultUser()
    {
        $result = UserHelper::createUsers();
        $this->assertDatabaseHas('users', [
            'id' => config('users.default_user.id'),
            'name' => config('users.default_user.name'),
            'email' => config('users.default_user.email'),
        ]);

        $this->assertTrue(Hash::check(config('users.default_user.password'), $result['user']->password));

        $this->assertDatabaseHas('teams', [
            'name' => config('users.default_user_Team.name'),
            'user_id' => $result['user']->id,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => config('users.default_professor.id'),
            'name' => config('users.default_professor.name'),
            'email' => config('users.default_professor.email'),
        ]);

        $this->assertTrue(Hash::check(config('users.default_professor.password'), $result['profesor']->password));

        $this->assertDatabaseHas('teams', [
            'name' => config('users.default_professor_Team.name'),
            'user_id' => $result['profesor']->id,
        ]);
    }
}
