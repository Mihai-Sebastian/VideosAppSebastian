<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersManageController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('manage-users')) {
            $users = User::all();
            return view('users.manage.index', compact('users'));
        }
        abort(403, 'No tens permisos per veure aquesta pàgina.');
    }

    public function create()
    {
        if (auth()->user()->can('manage-users')) {
            $roles = Role::all(); // Obtenir tots els rols
            return view('users.manage.create', compact('roles'));
        }
        abort(403, 'No tens permisos per crear un usuari.');
    }



    public function store(Request $request)
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        // Validació de les dades
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        // Crear l'usuari
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'super_admin' => ($request->role === 'super_admin') ? 1 : 0,
        ]);

        // Crear un Team amb el mateix nom de l'usuari
        $team = Team::create([
            'name' => $user->name . "'s Team",
            'user_id' => $user->id,
            'personal_team' => 1,
        ]);

        // Assignar el Team a l'usuari
        $user->update(['current_team_id' => $team->id]);

        // Assignar el rol seleccionat
        $user->assignRole($request->role);
        $user->save();
        return redirect()->route('users.manage.index')->with('success', 'Usuari i Team creats correctament.');
    }


    public function edit($id)
    {
        if (auth()->user()->can('manage-users')) {
            $user = User::findOrFail($id);
            $roles = Role::all();
            return view('users.manage.edit', compact('user', 'roles'));
        }
        abort(403, 'No tens permisos per editar aquest usuari.');
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        // Validar les dades
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        // Començar una transacció per assegurar-nos que tot es fa correctament
        DB::beginTransaction();

        try {
            // Obtenir l'usuari a actualitzar
            $user = User::findOrFail($id);

            // Actualitzar les dades generals de l'usuari
            $user->name = $request->name;
            $user->email = $request->email;

            // Si es proporciona una nova contrasenya, actualitzar-la
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Actualitzar el rol de l'usuari
            $user->syncRoles([$request->role]);

            // Assignar el Team si cal
            if ($request->role === 'super_admin') {
                // Per exemple, si és un super admin, assignem el primer equip
                $team = Team::first(); // O crear un equip si cal
                $user->current_team_id = $team->id;
            }

            // Desar les actualitzacions
            $user->save();

            // Finalitzar la transacció
            DB::commit();

            return redirect()->route('users.manage.index')->with('success', 'Usuari actualitzat correctament.');
        } catch (\Exception $e) {
            // Si alguna cosa falla, revertir les operacions
            DB::rollback();

            // Mostrar l'error
            return back()->with('error', 'Hi ha hagut un error al actualitzar l\'usuari: ' . $e->getMessage());
        }
    }


    public function delete($id)
    {
        if (auth()->user()->can('manage-users')) {
            $user = User::findOrFail($id);
            return view('users.manage.delete', compact('user'));
        }
        abort(403, 'No tens permisos per eliminar aquest usuari.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('manage-users')) {
            abort(403, 'No tens permisos per realitzar aquesta acció.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.manage.index')->with('success', 'Usuari eliminat correctament.');
    }
}
