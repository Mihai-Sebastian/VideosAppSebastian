<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideosApp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Paleta de colors */
            --primary-color: #ff3e3e;
            --primary-hover: #ff5252;
            --secondary-color: #3a3a3a;
            --background-dark: #121212;
            --card-bg: #1e1e1e;
            --text-primary: #ffffff;
            --text-secondary: #b0b0b0;

            /* Escala tipogràfica */
            --font-small: 0.75rem;
            --font-base: 1rem;
            --font-lg: 1.5rem;
            --font-xl: 2rem;

            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        /* Marges i padding universals */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            font-size: var(--font-base);
        }

        /* Superposició a modals i dropdowns */
        .modal-backdrop,
        .dropdown-menu {
            z-index: 1050 !important;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .dropdown-menu {
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 10px;
        }

        /* Uniformitat en botons, inputs, i components */
        button,
        a.btn,
        .form-control {
            font-size: var(--font-base);
            padding: 10px 20px;
            border-radius: var(--border-radius);
        }




        /* Estils generals */
        body {
            background-color: var(--background-dark);
            color: var(--text-primary);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar-custom {
            background-color: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .nav-link {
            color: var(--text-primary) !important;
            font-weight: 500;
            margin: 0 10px;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            background-color: rgba(255, 62, 62, 0.1);
            color: var(--primary-color) !important;
        }

        .logout-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 15px rgba(255, 62, 62, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 62, 62, 0.4);
        }

        /* Contenidor principal */
        .main-container {
            flex-grow: 1;
            padding: 30px 0;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Títols */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        h1 {
            font-size: 2.5rem;
            background: linear-gradient(45deg, var(--primary-color), #ff8a8a);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Cards i contenidors */
        .custom-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            border: 1px solid rgba(255, 255, 255, 0.05);
            height: 100%;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .card-header-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            color: white;
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: none;
        }

        .card-body-custom {
            padding: 25px;
        }

        /* Botons */
        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 15px rgba(255, 62, 62, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 62, 62, 0.4);
        }

        .btn-secondary-custom {
            background-color: var(--secondary-color);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        .btn-secondary-custom:hover {
            background-color: #4a4a4a;
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background: linear-gradient(45deg, #ff3e3e, #ff5252);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        .btn-danger-custom:hover {
            background: linear-gradient(45deg, #ff5252, #ff6b6b);
            transform: translateY(-2px);
        }

        .btn-warning-custom {
            background: linear-gradient(45deg, #ffb700, #ffc730);
            border: none;
            color: #333;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        .btn-warning-custom:hover {
            background: linear-gradient(45deg, #ffc730, #ffd460);
            transform: translateY(-2px);
        }

        /* Reproductor de vídeo */
        .video-player-container {
            position: relative;
            width: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            margin-bottom: 30px;
            background-color: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .video-player {
            width: 100%;
            height: 70vh;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .video-title-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
            z-index: 10;
        }

        .video-title-overlay h2 {
            color: white;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }

        .video-info-container {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .video-description {
            color: var(--text-secondary);
            margin-bottom: 20px;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .video-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            color: var(--text-secondary);
        }

        .video-meta-info div {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .video-meta-info i {
            color: var(--primary-color);
        }

        .video-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .video-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        /* Llista de vídeos */
        .video-list-item {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 15px;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            padding: 15px;
        }

        .video-list-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .video-thumbnail-container {
            flex: 0 0 120px;
            margin-right: 20px;
        }

        .video-thumbnail {
            width: 120px;
            height: 68px;
            object-fit: cover;
            border-radius: 8px;
        }

        .video-list-info {
            flex: 1;
        }

        .video-list-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--text-primary);
        }

        .video-list-meta {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .video-list-actions {
            margin-left: 15px;
        }

        /* Formularis */
        .form-control {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            border-radius: 8px;
            padding: 12px 15px;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 62, 62, 0.25);
            color: var(--text-primary);
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-select {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            border-radius: 8px;
            padding: 12px 15px;
        }

        .form-select:focus {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 62, 62, 0.25);
            color: var(--text-primary);
        }

        /* Badges i etiquetes */
        .badge-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
            margin-right: 5px;
        }

        /* Peu de pàgina */
        .footer-custom {
            background-color: rgba(18, 18, 18, 0.95);
            padding: 30px 0;
            text-align: center;
            margin-top: 50px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-content {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .footer-content a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color var(--transition-speed) ease;
        }

        .footer-content a:hover {
            color: var(--primary-hover);
        }

        .custom-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); /* Ombra per elevació */
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;

        }

        .alert-success-custom {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }

        .alert-danger-custom {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }

        .alert-info-custom {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
            border-left: 4px solid #17a2b8;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .video-player {
                height: 60vh;
            }
        }

        @media (max-width: 768px) {
            .video-player {
                height: 50vh;
            }

            .video-actions {
                flex-direction: column;
                gap: 10px;
            }

            .video-navigation {
                flex-direction: column;
                gap: 15px;
            }

            .video-meta-info {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .video-player {
                height: 40vh;
            }

            .video-list-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .video-thumbnail-container {
                margin-right: 0;
                margin-bottom: 15px;
                width: 100%;
            }

            .video-thumbnail {
                width: 100%;
                height: auto;
                aspect-ratio: 16/9;
            }

            .video-list-actions {
                margin-left: 0;
                margin-top: 15px;
                width: 100%;
                display: flex;
                justify-content: flex-end;
            }


        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">


        <a class="navbar-brand" href="{{ route('videos.index') }}">
            <i class="fas fa-play-circle"></i> VideosApp
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('videos.index') ? 'active' : '' }}" href="{{ route('videos.index') }}">
                        <i class="fas fa-video me-1"></i> Vídeos
                    </a>
                </li>
                @auth
                    @can('manage-videos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('videos.manage.*') ? 'active' : '' }}" href="{{ route('videos.manage.index') }}">
                                <i class="fas fa-cog me-1"></i> Gestionar Vídeos
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-users me-1"></i> Usuaris
                        </a>
                    </li>
                    @can('manage-users')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.manage.*') ? 'active' : '' }}" href="{{ route('users.manage.index') }}">
                                <i class="fas fa-user-cog me-1"></i> Gestionar Usuaris
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('series.index') ? 'active' : '' }}" href="{{ route('series.index') }}">
                            <i class="fas fa-film me-1"></i> Sèries
                        </a>
                    </li>
                    @can('manage-series')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('series.manage.*') ? 'active' : '' }}" href="{{ route('series.manage.index') }}">
                                <i class="fas fa-tasks me-1"></i> Gestionar Sèries
                            </a>
                        </li>
                    @endcan
                        @if(auth()->user()->super_admin)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('notificacions') ? 'active' : '' }}" href="{{ url('/notificacions') }}">
                                    <i class="fas fa-bell me-1"></i> Notificacions
                                </a>
                            </li>
                        @endif
                @endauth
            </ul>
            <div class="d-flex">
                @auth
                    <div class="dropdown ms-3">
                        <button class="btn btn-secondary-custom dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user-circle me-2"></i> Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="fas fa-sign-out-alt me-2"></i> Tancar Sessió</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-primary-custom">
                        <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sessió
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>

<!-- Contingut principal -->
<div class="main-container">
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success-custom" id="flash-message">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger-custom" id="flash-message">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info-custom" id="flash-message">
                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
            </div>
        @endif
    </div>
    {{ $slot }}
</div>

<!-- Peu de pàgina -->
<footer class="footer-custom">
    <div class="container">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} VideosApp. Tots els drets reservats.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flashes = document.querySelectorAll('#flash-message');
        flashes.forEach(flash => {
            setTimeout(() => {
                flash.style.opacity = '0';
                flash.style.transition = 'opacity 0.5s ease';
                setTimeout(() => flash.remove(), 500);
            }, 4000);
        });
    });
</script>


</body>
</html>
