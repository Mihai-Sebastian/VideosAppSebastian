<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Llista d'Usuaris</h1>

        <form method="GET" action="{{ route('users.index') }}" class="mb-5 d-flex justify-content-center">
            <div class="input-group w-100 col-12 col-md-6" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Cerca per nom o email..." value="{{ request()->get('search') }}" data-qa="input-search">
                <button type="submit" class="btn btn-primary-custom" data-qa="button-search">
                    🔍 Cercar
                </button>
            </div>
        </form>

        <!-- Taula d'usuaris -->
        <div class="custom-card p-4 mt-4">
            <div class="table-responsive">
                <table class="table table-hover text-center w-100" style="min-width: 600px;">
                    <thead style="background: linear-gradient(45deg, var(--primary-color), var(--primary-hover)); color: white;">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Accions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr style="background-color: var(--card-bg); color: var(--text-primary);">
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                @foreach ($user->roles as $role)
                                    <span class="badge-custom">{{ ucfirst($role->name) }}</span>
                                @endforeach
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary-custom btn-sm" data-qa="button-view-details">
                                    🔍 Veure Detalls
                                </a>
                            </td>
                        </tr>
                        <tr style="height: 6px;"></tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No s'han trobat usuaris.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginació -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-videos-app-layout>
