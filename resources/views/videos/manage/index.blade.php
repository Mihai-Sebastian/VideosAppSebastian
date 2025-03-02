<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Gestió de Vídeos</h1>

        <a href="{{ route('videos.manage.create') }}" class="btn btn-primary mb-3" data-qa="create-video-btn">Afegir Vídeo</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Títol</th>
                <th>Descripció</th>
                <th>Accions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->description }}</td>
                    <td>
                        <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn btn-warning btn-sm" data-qa="edit-video-btn">Editar</a>
                        <a href="{{ route('videos.manage.delete', $video->id) }}" class="btn btn-danger btn-sm" data-qa="delete-video-btn">Eliminar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if($videos->isEmpty())
            <p class="text-center">No hi ha vídeos disponibles.</p>
        @endif
    </div>
</x-videos-app-layout>
