<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class UserHelper
{
    public static function createUsers()
    {
        $userData = config('users.default_user');
        $userTeamData = config('users.default_user_Team');
        $professorData = config('users.default_professor');
        $professorTeamData = config('users.default_professor_Team');

        $user = User::create([
            'id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'current_team_id' => $userData['current_team_id'],
        ]);

        $user_team = Team::create([
            'id' => $userTeamData['id'],
            'user_id' => $userData['id'],
            'name' => $userTeamData['name'],
            'personal_team' => $userTeamData['personal_team'],
        ]);

        $professorData = User::create([
            'id' => $professorData['id'],
            'name' => $professorData['name'],
            'email' => $professorData['email'],
            'password' => Hash::make($professorData['password']),
            'current_team_id' => $professorData['current_team_id'],
        ]);
        $professorTeamData = Team::create([
            'id' => $professorTeamData['id'],
            'user_id' => $professorData['id'],
            'name' => $professorTeamData['name'],
            'personal_team' => $professorTeamData['personal_team'],
        ]);
        return [
            'user' => $user,
            'team' => $user_team,
            'profesor' => $professorData,
            'profesor_team' => $professorTeamData,
        ];
    }
}
