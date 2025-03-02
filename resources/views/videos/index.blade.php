<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Vídeos Disponibles</h1>

        <!-- Fila horitzontal de vídeos -->
        <div class="video-row d-flex justify-content-center overflow-auto">
            @foreach($videos as $video)
                <div class="video-card mr-4">
                    <div class="card shadow-sm hover-effect">
                        <!-- Enllaç al vídeo individual -->
                        <a href="{{ route('videos.show', $video->id) }}" data-qa="video-link-{{ $video->id }}" title="Veure vídeo: {{ $video->title }}">
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
                        </a>
                    </div>
                    <!-- Títol del vídeo amb estil atractiu fora de la card -->
                    <div class="video-title-container text-center">
                        <h5 class="card-title">
                            <a href="{{ route('videos.show', $video->id) }}" class="text-white text-decoration-none video-title" data-qa="video-title-{{ $video->id }}" title="Veure vídeo: {{ $video->title }}">
                                {{ $video->title }}
                            </a>
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Missatge en cas que no hi hagi vídeos disponibles -->
        @if($videos->isEmpty())
            <p class="text-center">No hi ha vídeos disponibles.</p>
        @endif

        <!-- Paginació -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Paginació de vídeos">
                <ul class="pagination">
                    <!-- Botó "Anterior" -->
                    <li class="page-item {{ $videos->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $videos->previousPageUrl() }}" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
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
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <style>
        /* Estils per a la paginació */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-item {
            margin: 0 5px;
        }

        .page-link {
            background-color: #282828;
            color: #fff;
            border: 1px solid #444;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .page-link:hover {
            background-color: #444;
            border-color: #666;
        }

        .page-item.active .page-link {
            background-color: #ff0000;
            border-color: #ff0000;
        }

        .page-item.disabled .page-link {
            background-color: #444;
            border-color: #666;
            color: #888;
            cursor: not-allowed;
        }

        /* Estils per a la fila horitzontal de vídeos */
        .video-row {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto; /* Permetre el desplaçament horitzontal */
            justify-content: center; /* Centrar els vídeos */
            padding-bottom: 20px; /* Màxim espai inferior */
        }

        .video-card {
            width: 300px; /* Amplada de cada vídeo */
            margin-right: 20px; /* Espai entre vídeos */
        }

        .video-card img {
            width: 100%; /* Ajustar la imatge per cobrir tot l'espai disponible */
            height: 180px; /* Mantenir la mateixa alçada */
            object-fit: cover; /* Ajustar la imatge sense deformar-la */
        }

        /* Efecte de passar per sobre de la card */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Estil per al títol del vídeo fora de la card */
        .video-title-container {
            margin-top: 10px; /* Espai entre la imatge i el títol */
        }

        .video-title {
            font-size: 1.25rem; /* Augmentar la mida de la font */
            font-weight: bold; /* Fer el títol més destacat */
            color: #fff; /* Color blanc per al títol */
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .video-title:hover {
            color: #ff0000; /* Color vermell quan es passa per sobre */
            transform: scale(1.1); /* Augmentar lleugerament la mida quan es passa per sobre */
        }

        /* Estil per al botó de "Veure més" */
        .btn-outline-primary {
            margin-top: 10px;
        }
    </style>
</x-videos-app-layout>
