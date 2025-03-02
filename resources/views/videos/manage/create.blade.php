<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Afegir Nou Vídeo</h1>

        <form action="{{ route('videos.manage.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Títol</label>
                <input type="text" class="form-control" id="title" name="title" data-qa="video-title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripció</label>
                <textarea class="form-control" id="description" name="description" data-qa="video-description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL del Vídeo</label>
                <input type="url" class="form-control" id="url" name="url" data-qa="video-url" required>
            </div>

            <button type="submit" class="btn btn-success" data-qa="submit-video-btn">Crear Vídeo</button>
        </form>
    </div>
</x-videos-app-layout>
