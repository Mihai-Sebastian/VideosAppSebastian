<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Mostrar una llista de tots els usuaris (accés obert).
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Obtenir el terme de cerca
        $search = $request->get('search');

        // Filtrar els usuaris per nom o email si es proporciona un terme de cerca
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10); // Paginació (pots canviar el número 10 segons les teves necessitats)

        // Retorna la vista amb els usuaris filtrats
        return view('users.index', compact('users'));
    }

    /**
     * Mostra els detalls d'un usuari específic (accés obert).
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Obtenim l'usuari amb els seus vídeos associats
        $user = User::with('videos')->findOrFail($id);

        // Retorna la vista amb les dades de l'usuari
        return view('users.show', compact('user'));
    }


}
