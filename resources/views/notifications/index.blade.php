<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Notificacions</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #f1f5f9;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 12px;
            transition: background-color 0.2s ease;
        }

        li:hover {
            background-color: #e2e8f0;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        small {
            display: block;
            color: #888;
            margin-top: 6px;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            color: #aaa;
            font-style: italic;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Notificacions ({{ $notifications->count() }})</h1>

    <ul>
        @forelse ($notifications as $notification)
            <li>
                Nou vídeo creat: <strong>{{ $notification->data['title'] }}</strong><br>
                <a href="{{ $notification->data['url'] }}" target="_blank">Veure vídeo</a>
                <small>{{ $notification->created_at->format('d/m/Y H:i') }}</small>
            </li>
        @empty
            <p class="empty">No tens notificacions.</p>
        @endforelse
    </ul>
</div>
</body>
</html>
