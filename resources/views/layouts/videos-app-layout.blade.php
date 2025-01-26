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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Contenidor de vídeo */
        .video-container {
            position: relative;
            padding-top: 56.25%; /* Relació d’aspecte 16:9 */
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        /* Informació del vídeo */
        .video-info {
            background-color: #282828;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .video-info p {
            color: #ccc;
            font-size: 1rem;
        }

        /* Botons de navegació */
        .video-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        /* Alineació dels botons de navegació */
        .video-navigation a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            color: white;
            background: linear-gradient(90deg, #ff4e50, #f9d423); /* Degradat modern */
            transition: transform 0.3s ease, background 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .video-navigation a:hover {
            background: linear-gradient(90deg, #ff3b3b, #f9c300); /* Canvi de degradat */
            transform: scale(1.05); /* Efecte d'expansió */
        }

        /* Alineació a la dreta quan només hi ha el botó de vídeo següent */
        .video-navigation .next-video-btn {
            margin-left: auto; /* Alinea el botó a la dreta si no hi ha botó anterior */
        }

        /* Peu de pàgina */
        footer {
            background-color: #202020;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #aaa;
        }
    </style>
</head>
<body>

<header>
    <h1>VideosApp</h1>
</header>

<main>
    {{ $slot }}
</main>

<footer>
    <p>&copy; {{ date('Y') }} VideosApp</p>
</footer>
</body>
</html>
