<?php

namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UserHelper extends TestCase
{
    public static function create_regular_user()
    {
        $user = User::create([
            'name' => 'Regular',
            'email' => 'regular@videosapp.com',
            'password' => bcrypt('123456789'),
            'current_team_id' => null,
        ]);

        $team = self::add_personal_team($user);
        $user->update(['current_team_id' => $team->id]);
        $user->save();

        return $user;
    }

    public static function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => bcrypt('123456789'),
            'current_team_id' => null,
        ]);
        $user->save();

        $team = self::add_personal_team($user);
        $user->update(['current_team_id' => $team->id]);
        $user->save();

        return $user;
    }

    public static function create_superadmin_user()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => true,
        ]);

        $team = self::add_personal_team($user);
        $user->update(['current_team_id' => $team->id]);
        $user->save();

        return $user;
    }

    public static function add_personal_team(User $user)
    {
        $team = Team::create([
            'user_id' => $user->id,
            'name' => "{$user->name}'s Team",
            'personal_team' => true,
        ]);

        return $team;
    }

    public static function define_gates()
    {
        Gate::define('manage-videos', function (User $user) {
            return $user->hasRole('video_manager') || $user->isSuperAdmin();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isSuperAdmin();
        });
    }

    public static function create_permissions()
    {
        Permission::firstOrCreate(['name' => 'manage-videos']);
        Permission::firstOrCreate(['name' => 'manage-users']);
    }
}
