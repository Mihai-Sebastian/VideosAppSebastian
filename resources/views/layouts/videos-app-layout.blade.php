<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideosApp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estils generals */
        body {
            background-color: #0f0f0f;
            color: #fff;
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
        nav {
            background-color: #202020;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 12px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #ff0000;
        }

        /* Encapçalament */
        header {
            background-color: #202020;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        header h1 {
            color: #ff0000;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }

        /* Contingut principal */
        main {
            flex-grow: 1;
            padding: 20px 0;
            width: 100%;
        }

        /* Contenidor del contingut */
        .content-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* YouTube-style video grid */
        .youtube-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        /* Video card styling */
        .video-card {
            background-color: #1e1e1e;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .video-thumbnail {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
        }

        .video-thumbnail img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-duration {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .video-info {
            padding: 12px;
        }

        .video-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-meta {
            color: #aaa;
            font-size: 14px;
        }

        /* Improved pagination */
        .youtube-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0;
            gap: 8px;
        }

        .youtube-pagination .page-item {
            list-style: none;
        }

        .youtube-pagination .page-link {
            background-color: #2d2d2d;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: inline-block;
            min-width: 40px;
            text-align: center;
        }

        .youtube-pagination .page-link:hover {
            background-color: #444;
        }

        .youtube-pagination .page-item.active .page-link {
            background-color: #ff0000;
            color: white;
        }

        .youtube-pagination .page-item.disabled .page-link {
            background-color: #222;
            color: #666;
            cursor: not-allowed;
        }

        /* Series header styling */
        .series-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .series-thumbnail {
            margin-bottom: 20px;
        }

        .series-thumbnail img {
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ff0000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .series-title {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .series-description {
            color: #aaa;
            max-width: 800px;
            margin: 0 auto 20px;
        }

        .series-stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            color: #aaa;
            font-size: 14px;
        }

        /* Peu de pàgina */
        footer {
            background-color: #202020;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            font-size: 14px;
            color: #aaa;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.3);
        }

        footer p {
            margin: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .youtube-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .youtube-pagination .page-numbers {
                display: none;
            }

            .youtube-pagination .page-prev,
            .youtube-pagination .page-next {
                display: block;
            }
        }

        @media (max-width: 576px) {
            .youtube-grid {
                grid-template-columns: 1fr;
            }

            .series-thumbnail img {
                width: 120px !important;
                height: 120px !important;
            }

            .series-title {
                font-size: 24px;
            }

            .series-stats {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav>
    <div>
        <a href="{{ route('videos.index') }}">Vídeos</a>
        @auth
                <a href="{{ route('videos.manage.index') }}">Gestionar Vídeos</a>
            <a href="{{ route('users.index') }}">Usuaris</a>
            @can('manage-users')
                <a href="{{ route('users.manage.index') }}">Gestionar Usuaris</a>
            @endcan
                <a href="{{ route('series.index') }}">Sèries</a>

            @can('manage-series')
                <a href="{{ route('series.manage.index') }}">Gestionar Sèries</a>
            @endcan

        @endauth
    </div>
    <div>
        @auth
            <!-- Formulari per tancar sessió -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                        style="background: none; border: none; color: white; cursor: pointer; font-weight: bold;">Tancar
                    Sessió
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar Sessió</a>
        @endauth
    </div>
</nav>

<header>
    <h1>VideosApp</h1>
</header>

<main>
    <div class="content-container">
        {{ $slot }}
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} VideosApp. Tots els drets reservats.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
