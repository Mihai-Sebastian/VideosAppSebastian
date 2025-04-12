<x-videos-app-layout>
    <div class="container">
        <!-- Series Header with Thumbnail -->
        <div class="series-header">
            <div class="series-thumbnail">
                <img src="{{ $serie->image ?? '/placeholder.svg?height=150&width=150' }}"
                     alt="{{ $serie->title }}"
                     style="width: 150px; height: 150px;">
            </div>
            <h1 class="series-title">{{ $serie->title }}</h1>
            <p class="series-description">
                {{ $serie->description ?? 'Col·lecció de vídeos d\'aquesta sèrie' }}
            </p>
            <div class="series-stats">
                <span><i class="fas fa-video me-2"></i> {{ $videos->total() }} vídeos</span>
                @if($serie->created_at)
                    <span><i class="fas fa-calendar me-2"></i> Des de {{ $serie->created_at->format('d/m/Y') }}</span>
                @endif
            </div>
        </div>

        <!-- Videos Grid -->
        @if($videos->count() > 0)
            <div class="youtube-grid">
                @foreach($videos as $video)
                    <a href="{{ route('videos.show', $video->id) }}" data-qa="video-link-{{ $video->id }}" title="Veure vídeo: {{ $video->title }}">
                        <div class="video-card">
                            <div class="video-thumbnail">

                        <!-- Extreure l'ID del vídeo de la URL embed -->
                        @php
                            $urlParts = explode('/', parse_url($video->url, PHP_URL_PATH));
                            $youtubeId = end($urlParts);
                            $youtubeId = strtok($youtubeId, '?');
                            $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/0.jpg" : asset('images/default-thumbnail.jpg');
                        @endphp
                        <img src="{{ $thumbnailUrl }}"
                             class="card-img-top"
                             alt="Miniatura del vídeo: {{ $video->title }}"
                             style="height: 180px; object-fit: cover;">
                            </div>
                            <div class="video-info">
                                <h3 class="video-title">{{ $video->title }}</h3>
                                <div class="video-meta">
                                    <div>{{ $video->published_at->format('d M, Y') }}</div>
                                    <div class="mt-1">{{ Str::limit($video->description, 60) }}</div>
                                </div>
                            </div>
                        </div>


                    </a>

                @endforeach
            </div>

            <!-- Simplified Pagination -->
            <div class="youtube-pagination">
                @if($videos->onFirstPage())
                    <span class="page-item disabled page-prev">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i> Anterior
                        </span>
                    </span>
                @else
                    <a href="{{ $videos->previousPageUrl() }}" class="page-item page-prev">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i> Anterior
                        </span>
                    </a>
                @endif

                <div class="d-none d-md-flex page-numbers">
                    @php
                        $start = max($videos->currentPage() - 2, 1);
                        $end = min($start + 4, $videos->lastPage());
                        $start = max(min($end - 4, $start), 1);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $videos->url(1) }}" class="page-item">
                            <span class="page-link">1</span>
                        </a>
                        @if($start > 2)
                            <span class="page-item disabled">
                                <span class="page-link">...</span>
                            </span>
                        @endif
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $videos->currentPage())
                            <span class="page-item active">
                                <span class="page-link">{{ $i }}</span>
                            </span>
                        @else
                            <a href="{{ $videos->url($i) }}" class="page-item">
                                <span class="page-link">{{ $i }}</span>
                            </a>
                        @endif
                    @endfor

                    @if($end < $videos->lastPage())
                        @if($end < $videos->lastPage() - 1)
                            <span class="page-item disabled">
                                <span class="page-link">...</span>
                            </span>
                        @endif
                        <a href="{{ $videos->url($videos->lastPage()) }}" class="page-item">
                            <span class="page-link">{{ $videos->lastPage() }}</span>
                        </a>
                    @endif
                </div>

                @if($videos->hasMorePages())
                    <a href="{{ $videos->nextPageUrl() }}" class="page-item page-next">
                        <span class="page-link">
                            Següent <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                @else
                    <span class="page-item disabled page-next">
                        <span class="page-link">
                            Següent <i class="fas fa-chevron-right"></i>
                        </span>
                    </span>
                @endif
            </div>
        @else
            <div class="text-center py-5 my-5">
                <div style="font-size: 4rem; margin-bottom: 20px;">😢</div>
                <h3 class="text-muted">No s'han trobat vídeos per aquesta sèrie</h3>
                <p class="text-muted mt-3">Torna més tard o explora altres sèries</p>
            </div>
        @endif
    </div>
</x-videos-app-layout>
