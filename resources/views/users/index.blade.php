<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Llista d'Usuaris</h1>

        <!-- Formulari de cerca -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Cerca per nom o email..." value="{{ request()->get('search') }}" data-qa="input-search">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" data-qa="button-search">Cercar</button>
            </div>
        </form>

        <!-- Taula d'usuaris -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Accions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-info">{{ ucfirst($role->name) }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info" data-qa="button-view-details">Veure Detalls</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No s'han trobat usuaris.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Paginació (si és necessari) -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</x-videos-app-layout>
