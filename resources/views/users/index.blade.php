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

        <!-- Llista d'usuaris amb targetes -->
        <div class="row">
            @forelse ($users as $user)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <x-card :title="$user->name" icon="fas fa-user">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Rol:</strong>
                            @foreach ($user->roles as $role)
                                <span class="badge-custom">{{ ucfirst($role->name) }}</span>
                            @endforeach
                        </p>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('users.show', $user->id) }}" class="btn-primary-custom btn-sm">
                                🔍 Veure Detalls
                            </a>
                        </div>
                    </x-card>
                </div>
            @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-info-circle me-2"></i>No s'han trobat usuaris.
                </div>
            @endforelse
        </div>


        <!-- Paginació -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-videos-app-layout>
