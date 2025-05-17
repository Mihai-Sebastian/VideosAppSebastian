<x-videos-app-layout>
    <div class="container">
        <h1>Detalls de l'Usuari: {{ $user->name }}</h1>

        <div class="custom-card mb-5">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Informació de l'Usuari</h5>
            </div>
            <div class="card-body-custom">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Nom:</h6>
                            <p class="fs-5">{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Email:</h6>
                            <p class="fs-5">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Rols:</h6>
                            <div>
                                @foreach ($user->roles as $role)
                                    <span class="badge-custom">{{ ucfirst($role->name) }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Super Administrador:</h6>
                            <p class="fs-5">
                                @if($user->super_admin)
                                    <span class="badge-custom">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Equip Actual:</h6>
                            <p class="fs-5">
                                @if($user->currentTeam)
                                    <span class="badge-custom">{{ $user->currentTeam->name }}</span>
                                @else
                                    <span class="badge bg-secondary">No assignat</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mb-4"><i class="fas fa-video me-2"></i>Vídeos de l'Usuari</h3>

        @if($user->videos->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aquest usuari no té vídeos associats.
            </div>
        @else
            <div class="row">
                @foreach ($user->videos as $video)
                    @php
                        // Extreure l'ID del vídeo de YouTube
                        $urlParts = explode('/', parse_url($video->url, PHP_URL_PATH));
                        $youtubeId = end($urlParts);
                        $youtubeId = strtok($youtubeId, '?');
                        $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/0.jpg" : asset('images/default-thumbnail.jpg');
                    @endphp

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="video-list-item">
                            <div class="video-thumbnail-container">
                                <img src="{{ $thumbnailUrl }}" alt="Miniatura: {{ $video->title }}" class="video-thumbnail">
                            </div>
                            <div class="video-list-info">
                                <h5 class="video-list-title">{{ $video->title }}</h5>
                                <div class="video-list-meta">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $video->formatted_published_at }}
                                </div>
                            </div>
                            <div class="video-list-actions">
                                <a href="{{ route('videos.show', $video->id) }}" class="btn-primary-custom btn-sm">
                                    <i class="fas fa-play me-1"></i> Veure
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ route('users.index') }}" class="btn-secondary-custom">
                <i class="fas fa-arrow-left me-2"></i>Tornar a la llista
            </a>
        </div>
    </div>
</x-videos-app-layout>
