<x-videos-app-layout>
    <div class="container py-5">
        <!-- Capçalera de la sèrie -->
        <div class="custom-card mb-5 p-4 text-center">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ $serie->image ?? '/placeholder.svg?height=150&width=150' }}"
                     alt="{{ $serie->title }}"
                     style="width: 150px; height: 150px; border-radius: 12px; object-fit: cover; box-shadow: 0 0 10px rgba(0,0,0,0.5);"
                     class="mb-3">
                <h1 class="mb-2">{{ $serie->title }}</h1>
                <p class="text-muted">{{ $serie->description ?? 'Col·lecció de vídeos d\'aquesta sèrie' }}</p>
                <div class="series-stats d-flex gap-3 justify-content-center mt-2 text-secondary small">
                    <span><i class="fas fa-video me-1"></i>{{ $videos->total() }} vídeos</span>
                    @if($serie->created_at)
                        <span><i class="fas fa-calendar me-1"></i>Des de {{ $serie->created_at->format('d/m/Y') }}</span>
                    @endif
                </div>

                <!-- Botons de gestió -->
                @auth
                    @if(auth()->user()->can('manage-series') || auth()->id() === $serie->user_id)
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <a href="{{ route('series.manage.edit', $serie->id) }}"
                               class="btn-warning-custom"
                               data-qa="edit-serie-btn">
                                ✏️ Editar sèrie
                            </a>
                            <a href="{{ route('series.manage.delete', $serie->id) }}"
                               class="btn-danger-custom"
                               data-qa="delete-serie-btn">
                                🗑️ Eliminar sèrie
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Llistat de vídeos -->
        @if($videos->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($videos as $video)
                    <div class="col">
                        <a href="{{ route('videos.show', $video->id) }}" class="text-decoration-none text-light" data-qa="video-link-{{ $video->id }}">
                            <div class="custom-card h-100">
                                <div class="video-thumbnail">
                                    @php
                                        $urlParts = explode('/', parse_url($video->url, PHP_URL_PATH));
                                        $youtubeId = end($urlParts);
                                        $youtubeId = strtok($youtubeId, '?');
                                        $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/0.jpg" : asset('images/default-thumbnail.jpg');
                                    @endphp
                                    <img src="{{ $thumbnailUrl }}"
                                         alt="Miniatura del vídeo: {{ $video->title }}"
                                         style="height: 180px; width: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body-custom">
                                    <h5 class="video-title mb-2">{{ $video->title }}</h5>
                                    <div class="video-meta text-secondary small">
                                        <div>{{ $video->published_at->format('d M, Y') }}</div>
                                        <div class="mt-1">{{ Str::limit($video->description, 60) }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Paginació -->
            <div class="youtube-pagination mt-5">
                {{ $videos->onEachSide(2)->links() }}
            </div>
        @else
            <!-- Sense vídeos -->
            <div class="text-center py-5 my-5">
                <div style="font-size: 4rem;" class="mb-3">😢</div>
                <h3 class="text-muted">No s'han trobat vídeos per aquesta sèrie</h3>
                <p class="text-muted mt-2">Torna més tard o explora altres sèries.</p>
            </div>
        @endif
    </div>
</x-videos-app-layout>
