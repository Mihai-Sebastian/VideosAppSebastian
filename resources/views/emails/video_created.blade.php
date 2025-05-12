<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Nou vídeo creat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>S'ha creat un nou vídeo!</h1>
    <p><strong>Títol:</strong> {{ $video->title }}</p>
    <p><strong>URL:</strong> <a href="{{ $video->url }}">{{ $video->url }}</a></p>

    <a href="{{ $video->url }}" class="button" target="_blank">Veure vídeo</a>

    <div class="footer">
        Aquest missatge ha estat generat automàticament per {{ config('app.name') }}.
    </div>
</div>
</body>
</html>
