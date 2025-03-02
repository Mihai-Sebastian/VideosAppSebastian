<x-videos-app-layout>
    <div class="container d-flex flex-column justify-content-center" style="min-height: 100vh;">
        <h1 class="text-center mb-4">{{ $video->title }}</h1>
        <p class="text-center mb-4">{{ $video->description }}</p>

        <!-- Contenidor de vídeo centrat -->
        <div class="d-flex justify-content-center" id="video-container">
            <div class="video-container">
                <iframe src="{{ $video->url }}"
                        frameborder="0"
                        allowfullscreen
                        style="width: 100%; height: 70vh;"> <!-- Alçada augmentada a 70vh -->
                </iframe>
            </div>
        </div>

        <!-- Informació del vídeo -->
        <div class="video-info text-center mt-4">
            <p><strong>Publicat el:</strong> {{ $video->formatted_published_at }}</p>
            <p><strong>Fa quant es va publicar?</strong> {{ $video->formatted_for_humans_published_at }}</p>
            <p><strong>Timestamp:</strong> {{ $video->published_at_timestamp }}</p>
        </div>

        <!-- Navegació entre vídeos -->
        <div class="video-navigation d-flex justify-content-between mt-4">
            @if($previous)
                <a href="{{ route('videos.show', $previous->id) }}" class="prev-video-btn btn btn-primary">⬅ Vídeo Anterior</a>
            @endif
            @if($next)
                <a href="{{ route('videos.show', $next->id) }}" class="next-video-btn btn btn-primary">Vídeo Següent ➡</a>
            @endif
        </div>
    </div>

    <style>
        /* Estils per al vídeo */
        .video-container {
            max-width: 100%;
            margin-bottom: 20px;
        }

        iframe {
            width: 100%;
            height: 70vh; /* Augmentat a 70% de l'alçada de la pantalla */
            border-radius: 8px;
        }

        /* Estils per a la informació del vídeo */
        .video-info p {
            margin: 10px 0;
        }

        /* Estils per a la navegació entre vídeos */
        .video-navigation a {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        /* Botons de navegació */
        .prev-video-btn {
            background-color: #007bff;
        }

        .next-video-btn {
            background-color: #007bff;
        }

        .prev-video-btn:hover, .next-video-btn:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        // Afegir un script per fer scroll automàtic fins al vídeo
        window.onload = function() {
            const videoElement = document.getElementById('video-container');
            videoElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };
    </script>
</x-videos-app-layout>
