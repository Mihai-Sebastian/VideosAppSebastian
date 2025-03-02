<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideosApp</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Estils generals */
        body {
            background-color: #181818;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Assegura que el body ocupi com a mínim l'alçada de la pantalla */
            overflow-x: hidden; /* Evitar desplaçament horitzontal */
        }

        /* Navbar */
        nav {
            background-color: #202020;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
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
        }

        /* Contingut principal */
        main {
            flex-grow: 1; /* Això fa que el contingut principal ocupi l'espai disponible */
            padding: 20px;
            width: 100%; /* Ocupa tot l'amplada disponible */
        }

        /* Contenidor del contingut */
        .content-container {
            max-width: 1400px; /* Amplada màxima del contingut */
            margin: 0 auto; /* Centrat horitzontalment */
            padding: 0 20px; /* Padding als costats */
        }

        /* Estil per a les files de vídeos */
        .video-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px; /* Espai entre vídeos */
            margin-bottom: 20px; /* Espai entre files */
        }

        /* Estil per a cada vídeo */
        .video-card {
            flex: 0 0 calc(25% - 12px); /* 4 vídeos per fila */
            background-color: #282828;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .video-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .video-card .video-info {
            padding: 12px;
        }

        .video-card .video-title {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .video-card .video-description {
            font-size: 0.9rem;
            color: #ccc;
        }

        /* Peu de pàgina */
        footer {
            background-color: #202020;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #aaa;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.3);
        }

        footer p {
            margin: 0;
        }

        /* Paginació */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            background-color: #282828;
            color: #fff;
            border: 1px solid #444;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .pagination .page-link:hover {
            background-color: #444;
        }

        .pagination .page-item.active .page-link {
            background-color: #ff0000;
            border-color: #ff0000;
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
        @endauth
    </div>
    <div>
        @auth
            <!-- Formulari per tancar sessió -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer; font-weight: bold;">Tancar Sessió</button>
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
</body>
</html>
