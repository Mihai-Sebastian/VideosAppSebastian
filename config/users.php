<?php
return [
    'default_user' => [
        'id' => env('DEFAULT_USER_ID', 1),
        'name' => env('DEFAULT_USER_NAME', 'User_Alumne'),
        'email' => env('DEFAULT_USER_EMAIL', 'alumne@iesebre.com'),
        'password' => env('DEFAULT_USER_PASSWORD', 'Alumne2004'),
        'current_team_id' => env('DEFAULT_USER_TEAM_ID', 1),
    ],
    'default_user_Team' => [
        'id' => env('DEFAULT_USER_TEAM_ID', 1),
        'user_id' => env('DEFAULT_USER_ID', 1),
        'name' => env('DEFAULT_USER_TEAM_NAME', 'Team_Alumne'),
        'personal_team' => env('DEFAULT_USER_PERSONAL_TEAM', TRUE),
    ],
    'default_professor'=>[
        'id' => env('DEFAULT_PROFESSOR_ID', 2),
        'name' => env('DEFAULT_PROFESSOR_NAME', 'User_Professor'),
        'email' => env('DEFAULT_PROFESSOR_EMAIL', 'professor@iesebre.com'),
        'password' => env('DEFAULT_PROFESSOR_PASSWORD', 'Professor2004'),
        'current_team_id' => env('DEFAULT_PROFESSOR_TEAM_ID', 2),
    ],
    'default_professor_Team' => [
        'id' => env('DEFAULT_PROFESSOR_TEAM_ID', 2),
        'user_id' => env('DEFAULT_PROFESSOR_ID', 2),
        'name' => env('DEFAULT_PROFESSOR_TEAM_NAME', 'Team_Professor'),
        'personal_team' => env('DEFAULT_USER_PERSONAL_TEAM', TRUE),
    ],
];
