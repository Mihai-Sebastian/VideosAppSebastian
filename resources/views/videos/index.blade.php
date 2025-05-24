<x-videos-app-layout>
    <div class="container py-5">
        <h1>Vídeos Disponibles</h1>

        @if($videos->isNotEmpty())
            <div class="row">
                @foreach($videos as $video)
                    @php
                        $urlParts = explode('/', parse_url($video->url, PHP_URL_PATH));
                        $youtubeId = end($urlParts);
                        $youtubeId = strtok($youtubeId, '?');
                        $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/0.jpg" : asset('images/default-thumbnail.jpg');
                    @endphp

                    <div class="col-12 col-md-6 col-lg-4">
                        <x-card :title="$video->title" icon="fas fa-play" :image="$thumbnailUrl">
                            <p><strong>Descripció:</strong> {{ $video->description }}</p>
                            <p><strong>Data:</strong> {{ $video->formatted_published_at ?? 'Sense data' }}</p>
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="{{ route('videos.show', $video->id) }}" class="btn-primary-custom btn-sm">
                                    🔍 Veure Vídeo
                                </a>
                            </div>
                        </x-card>
                    </div>
                @endforeach
            </div>

            <!-- Paginador personalitzat -->
            @if($videos->hasPages())
                <div class="pagination-container">
                    <nav aria-label="Paginació de vídeos">
                        <ul class="custom-pagination">
                            <!-- Botó "Anterior" -->
                            <li class="page-item {{ $videos->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $videos->previousPageUrl() }}" aria-label="Anterior">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>

                            <!-- Números de pàgina -->
                            @for ($i = 1; $i <= $videos->lastPage(); $i++)
                                <li class="page-item {{ $videos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $videos->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Botó "Següent" -->
                            <li class="page-item {{ $videos->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $videos->nextPageUrl() }}" aria-label="Següent">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        @else
            <div class="empty-videos">
                <div class="empty-icon">
                    <i class="fas fa-film"></i>
                </div>
                <p>No hi ha vídeos disponibles.</p>
            </div>
        @endif

        <!-- Botó flotant per crear nou vídeo -->
        @auth
            <a href="{{ route('videos.manage.create') }}" class="floating-action-button" title="Crear nou vídeo" aria-label="Crear nou vídeo">
                <i class="fas fa-plus"></i>
            </a>
        @endauth

    </div>

    <style>
        .row {
            row-gap: 30px;
        }

        /* Estils per al paginador */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .custom-pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
        }

        .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--card-bg);
            color: var(--text-primary);
            border-radius: 8px;
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .page-item .page-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .page-item.active .page-link {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
        }

        .page-item.disabled .page-link {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-secondary);
            cursor: not-allowed;
            opacity: 0.5;
        }

        .empty-videos {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .floating-action-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 20px rgba(255, 62, 62, 0.4);
            transition: all var(--transition-speed) ease;
            z-index: 999;
        }

        .floating-action-button:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 6px 25px rgba(255, 62, 62, 0.5);
            color: white;
            text-decoration: none;
        }
    </style>
</x-videos-app-layout>
