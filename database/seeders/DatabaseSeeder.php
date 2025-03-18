<?php

namespace Database\Seeders;

use App\Helpers\VideoHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Helpers\UserHelper;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuaris per defecte utilitzant els helpers
        UserHelper::create_regular_user();
        UserHelper::create_video_manager_user();
        UserHelper::create_superadmin_user();

        // Crear permisos utilitzant el helper
        UserHelper::create_permissions();
        // Crear rols i assignar permisos
        $this->createRoles();

        // Assignar rols als usuaris
        $this->assignRolesToUsers();

        VideoHelper::createDefaultVideo();

    }
    private function createRoles()
    {
        // Crear o obtenir rols existents
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $videoManagerRole = Role::firstOrCreate(['name' => 'video_manager']);
        $regularUserRole = Role::firstOrCreate(['name' => 'regular_user']);

        // Assignar permisos als rols
        $videoManagerRole->givePermissionTo('manage-videos');
        $superAdminRole->givePermissionTo(['manage-videos', 'manage-users']);
    }
    private function assignRolesToUsers()
    {
        $superAdmin = User::where('email', 'superadmin@videosapp.com')->first();
        if ($superAdmin) {
            $superAdmin->assignRole('super_admin');
            $superAdmin->givePermissionTo(['manage-videos', 'manage-users']);
        }

        $videoManager = User::where('email', 'videosmanager@videosapp.com')->first();
        if ($videoManager) {
            $videoManager->assignRole('video_manager');
            $videoManager->givePermissionTo('manage-videos');
        }

        $regularUser = User::where('email', 'regular@videosapp.com')->first();
        if ($regularUser) {
            $regularUser->assignRole('regular_user');
        }
    }

}
