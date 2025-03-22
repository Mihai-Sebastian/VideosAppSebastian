<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Detalls de l'Usuari: {{ $user->name }}</h1>

        <!-- Informació de l'usuari -->
        <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold;">
                <h5>Informació de l'Usuari</h5>
            </div>
            <div class="card-body p-4">
                <p><strong>Nom:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                <p><strong>Rols:</strong>
                    @foreach ($user->roles as $role)
                        <span class="badge" style="background: #ff5733; color: white; padding: 6px 12px; border-radius: 10px; font-weight: bold;">{{ ucfirst($role->name) }}</span>
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
        <h3 class="mt-5" style="color: #ff5733; font-weight: bold;">Vídeos de l'Usuari</h3>
        @if($user->videos->isEmpty())
            <p>Aquest usuari no té vídeos associats.</p>
        @else
            <ul class="list-group">
                @foreach ($user->videos as $video)
                    <li class="list-group-item" style="background-color: #282828; color: white; margin-bottom: 10px; border-radius: 10px; display: flex; align-items: center;">
                        <!-- Mostra la miniatura del vídeo -->
                        @php
                            // Extreure l'ID del vídeo de YouTube
                            $urlParts = explode('/', parse_url($video->url, PHP_URL_PATH));
                            $youtubeId = end($urlParts);
                            $youtubeId = strtok($youtubeId, '?');
                            $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/0.jpg" : asset('images/default-thumbnail.jpg');
                        @endphp

                        <div style="display: flex; align-items: center;">
                            <img src="{{ $thumbnailUrl }}"
                                 alt="Miniatura del vídeo: {{ $video->title }}"
                                 class="card-img-top"
                                 style="width: 100px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;">
                            <strong>{{ $video->title }}</strong>
                        </div>

                        <!-- Botó 'Veure Vídeo' amb separació lleugera -->
                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; border-radius: 20px; padding: 8px 15px; font-weight: bold; transition: 0.3s; margin-left: 15px;">Veure Vídeo</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-4" style="display: flex; justify-content: center;">
            <!-- Botó de Tornar a la llista d'usuaris amb estil modificat -->
            <a href="{{ route('users.index') }}" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold; padding: 12px 30px; border-radius: 25px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease-in-out;">
                Tornar a la llista
            </a>
        </div>
    </div>
</x-videos-app-layout>
