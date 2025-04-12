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
        UserHelper::define_gates();
        // Crear usuaris per defecte utilitzant els helpers
        UserHelper::create_regular_user();
        UserHelper::create_video_manager_user();
        UserHelper::create_superadmin_user();
        UserHelper::create_series_manager_user();


        // Crear permisos utilitzant el helper
        UserHelper::create_permissions();
        // Crear rols i assignar permisos
        $this->createRoles();

        // Assignar rols als usuaris
        $this->assignRolesToUsers();

        VideoHelper::createDefaultVideo();
        VideoHelper::createDefaultSeries();


    }
    private function createRoles()
    {
        // Crear o obtenir rols existents
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $videoManagerRole = Role::firstOrCreate(['name' => 'video_manager']);
        $regularUserRole = Role::firstOrCreate(['name' => 'regular_user']);
        $seriesManagerRole = Role::firstOrCreate(['name' => 'series_manager']);

        // Assignar permisos als rols
        $videoManagerRole->givePermissionTo('manage-videos');
        $seriesManagerRole->givePermissionTo('manage-series');
        $superAdminRole->givePermissionTo(['manage-videos', 'manage-users', 'manage-series']);
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
        $seriesManager = User::where('email', 'seriesmanager@videosapp.com')->first();
        if ($seriesManager) {
            $seriesManager->assignRole('series_manager');
            $seriesManager->givePermissionTo('manage-series');
        }

        $regularUser = User::where('email', 'regular@videosapp.com')->first();
        if ($regularUser) {
            $regularUser->assignRole('regular_user');
        }
    }

}
