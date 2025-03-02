<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4 text-danger">Eliminar Vídeo</h1>

        <p>Estàs segur que vols eliminar el vídeo <strong>{{ $video->title }}</strong>?</p>

        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger" data-qa="confirm-delete-video-btn">Sí, eliminar</button>
            <a href="{{ route('videos.manage.index') }}" class="btn btn-secondary" data-qa="cancel-delete-video-btn">Cancel·lar</a>
        </form>
    </div>
</x-videos-app-layout>
