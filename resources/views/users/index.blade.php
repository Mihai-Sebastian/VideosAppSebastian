<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Llista d'Usuaris</h1>

        <form method="GET" action="{{ route('users.index') }}" class="mb-5 d-flex justify-content-center">
            <div class="input-group shadow-sm rounded w-100 col-12 col-md-6" style="border: 2px solid #ff5733; padding: 8px; background: #f8f9fa; margin-bottom: 8px;">
                <input type="text" name="search" class="form-control border-0" placeholder="Cerca per nom o email..." value="{{ request()->get('search') }}" data-qa="input-search">
                <button type="submit" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold; border-radius: 5px;" data-qa="button-search">🔍 Cercar</button>
            </div>
        </form>

        <!-- Taula d'usuaris -->
        <div class="table-responsive mt-4" style="overflow-x: auto;">
            <div class="card-body p-4">
                <!-- Contenidor amb desplaçament horitzontal només per a la taula -->
                <div style="overflow-x: auto;">
                    <table class="table table-hover text-center w-100" style="min-width: 600px;">
                        <thead style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white;">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr style="background: #282828; color: white; height: 70px;">
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">
                                    @foreach ($user->roles as $role)
                                        <span class="badge" style="background: #ff5733; color: white; padding: 6px 12px; border-radius: 10px; font-weight: bold;">{{ ucfirst($role->name) }}</span>
                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    <!-- Botó "Veure Detalls" ajustat per a mòbils -->
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; border-radius: 20px; padding: 6px 12px; font-weight: bold; transition: 0.3s; font-size: 14px;" data-qa="button-view-details">🔍 Veure Detalls</a>
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
        </div>

        <!-- Paginació (si és necessari) -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-videos-app-layout>
