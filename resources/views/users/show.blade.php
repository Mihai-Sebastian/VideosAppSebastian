<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Detalls de l'Usuari: {{ $user->name }}</h1>

        <!-- Informació de l'usuari -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informació de l'Usuari</h5>
            </div>
            <div class="card-body">
                <p><strong>Nom:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                <p><strong>Rols:</strong>
                    @foreach ($user->roles as $role)
                        <span class="badge bg-info">{{ ucfirst($role->name) }}</span>
                    @endforeach
                </p>

                <p><strong>Super Administrador:</strong>
                    {{ $user->super_admin ? 'Sí' : 'No' }}
                </p>

                <p><strong>Equip Actual:</strong>
                    {{ $user->currentTeam ? $user->currentTeam->name : 'No assignat' }}
                </p>
            </div>
        </div>

        <!-- Llistat de vídeos de l'usuari -->
        <h3>Vídeos de l'Usuari</h3>
        @if($user->videos->isEmpty())
            <p>Aquest usuari no té vídeos associats.</p>
        @else
            <ul class="list-group">
                @foreach ($user->videos as $video)
                    <li class="list-group-item">
                        <strong>{{ $video->title }}</strong><br>
                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-primary btn-sm">Veure Vídeo</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Tornar a la llista d'usuaris</a>
        </div>
    </div>
</x-videos-app-layout>
