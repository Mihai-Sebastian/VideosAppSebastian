<x-videos-app-layout>
    <div class="container py-5">
        <h1>Vídeos Disponibles</h1>

        @if($videos->isNotEmpty())
            <!-- Secció de vídeos destacats -->
            <div class="videos-section">
                <div class="videos-container">
                    @foreach($videos as $video)
                        <div class="video-card-wrapper">
                            @php
                                $urlParts = explode('/', parse_url($video->url, PHP_URL_PATH));
                                $youtubeId = end($urlParts);
                                $youtubeId = strtok($youtubeId, '?');
                                $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/0.jpg" : asset('images/default-thumbnail.jpg');
                            @endphp

                            <div class="video-card">
                                <a href="{{ route('videos.show', $video->id) }}" class="video-thumbnail-link" data-qa="video-link-{{ $video->id }}">
                                    <div class="video-thumbnail-container">
                                        <img src="{{ $thumbnailUrl }}" alt="Miniatura: {{ $video->title }}" class="video-thumbnail">
                                        <div class="video-duration">
                                            <i class="fas fa-play"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="video-info">
                                    <h3 class="video-title">
                                        <a href="{{ route('videos.show', $video->id) }}" data-qa="video-title-{{ $video->id }}">
                                            {{ $video->title }}
                                        </a>
                                    </h3>
                                    <div class="video-meta">
                                        <span class="video-date">
                                            <i class="fas fa-calendar-alt me-1"></i>{{ $video->formatted_published_at ?? 'Sense data' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Missatge en cas que no hi hagi vídeos disponibles -->
            <div class="empty-videos">
                <div class="empty-icon">
                    <i class="fas fa-film"></i>
                </div>
                <p>No hi ha vídeos disponibles.</p>
            </div>
        @endif

        <!-- Paginació -->
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

        <!-- Botó flotant per crear nou vídeo -->
        @auth
            <a href="{{ route('videos.manage.create') }}" class="floating-action-button" title="Crear nou vídeo" aria-label="Crear nou vídeo">
                <i class="fas fa-plus"></i>
            </a>
        @endauth
    </div>

    <style>
        /* Estils per a la secció de vídeos */
        .videos-section {
            margin-bottom: 40px;
        }

        .videos-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Estils per a les targetes de vídeo */
        .video-card-wrapper {
            transition: transform var(--transition-speed) ease;
        }

        .video-card-wrapper:hover {
            transform: translateY(-5px);
        }

        .video-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            height: 100%;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .video-thumbnail-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* Relació d'aspecte 16:9 */
            overflow: hidden;
        }

        .video-thumbnail {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-speed) ease;
        }

        .video-thumbnail-link:hover .video-thumbnail {
            transform: scale(1.05);
        }

        .video-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .video-info {
            padding: 15px;
        }

        .video-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-title a {
            color: var(--text-primary);
            text-decoration: none;
            transition: color var(--transition-speed) ease;
        }

        .video-title a:hover {
            color: var(--primary-color);
        }

        .video-meta {
            color: var(--text-secondary);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Estils per a la paginació */
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

        /* Estil per al botó flotant */
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

        /* Estil per a la secció buida */
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

        /* Responsive */
        @media (max-width: 768px) {
            .videos-container {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 15px;
            }
        }

        @media (max-width: 576px) {
            .videos-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</x-videos-app-layout>
