<x-videos-app-layout>
    <div class="container">
        <div class="video-player-container">
            <div class="video-title-overlay">
                <h2>{{ $video->title }}</h2>
            </div>
            <iframe
                class="video-player"
                src="{{ $video->url }}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        </div>

        <div class="video-info-container">
            <div class="video-description">
                {{ $video->description }}
            </div>

            <div class="video-meta-info">
                <div>
                    <i class="fas fa-calendar-alt"></i>
                    <span>Publicat el: {{ $video->formatted_published_at }}</span>
                </div>
                <div>
                    <i class="fas fa-clock"></i>
                    <span>Fa: {{ $video->formatted_for_humans_published_at }}</span>
                </div>
                <div>
                    <i class="fas fa-stopwatch"></i>
                    <span>Timestamp: {{ $video->published_at_timestamp }}</span>
                </div>
            </div>

            @auth
                @if(auth()->id() === $video->user_id || auth()->user()->can('manage-videos'))
                    <div class="video-actions">
                        <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn-warning-custom">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <a href="{{ route('videos.manage.delete', $video->id) }}" class="btn-danger-custom">
                            <i class="fas fa-trash-alt me-2"></i>Eliminar
                        </a>
                    </div>
                @endif
            @endauth

            <div class="video-navigation">
                @if($previous)
                    <a href="{{ route('videos.show', $previous->id) }}" class="btn-primary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Vídeo Anterior
                    </a>
                @else
                    <div></div> <!-- Espai buit per mantenir la distribució -->
                @endif

                @if($next)
                    <a href="{{ route('videos.show', $next->id) }}" class="btn-primary-custom">
                        Vídeo Següent<i class="fas fa-arrow-right ms-2"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Scroll automàtic fins al vídeo amb animació suau
        window.onload = function() {
            const videoElement = document.querySelector('.video-player-container');
            if (videoElement) {
                videoElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        };
    </script>
</x-videos-app-layout>
