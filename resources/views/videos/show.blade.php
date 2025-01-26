<x-videos-app-layout>
    <div class="container">
        <h1>{{ $video->title }}</h1>
        <p>{{ $video->description }}</p>

        <div class="video-container">
            <iframe width="420" height="236"
                    src="{{ $video->url }}"
                    frameborder="0"
                    allowfullscreen>
            </iframe>
        </div>


        <p><strong>Publicat el:</strong> {{ $video->formatted_published_at }}</p>
        <p><strong>Fa quant es va publicar?</strong> {{ $video->formatted_for_humans_published_at }}</p>
        <p><strong>Timestamp:</strong> {{ $video->published_at_timestamp }}</p>

        <div class="video-navigation">
            @if($video->previous)
                <a href="{{ route('videos.show', $video->previous) }}" class="prev-video-btn">⬅ Vídeo Anterior</a>
            @endif
            @if($video->next)
                <a href="{{ route('videos.show', $video->next) }}" class="next-video-btn">Vídeo Següent ➡</a>
            @endif
        </div>
    </div>
</x-videos-app-layout>
