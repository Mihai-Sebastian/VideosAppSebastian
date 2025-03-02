<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Editar Vídeo</h1>

        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Títol</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" data-qa="video-title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripció</label>
                <textarea class="form-control" id="description" name="description" data-qa="video-description" required>{{ $video->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL del Vídeo</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $video->url }}" data-qa="video-url" required>
            </div>


            <button type="submit" class="btn btn-primary" data-qa="update-video-btn">Actualitzar Vídeo</button>
        </form>
    </div>
</x-videos-app-layout>
