<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Crear Nova Sèrie</h1>

        <form action="{{ route('series.manage.store') }}" method="POST" data-qa="create-series-form">
            @csrf

            <div class="form-group mb-3">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="title" class="form-label">Títol</label>
                        <input type="text" name="title" id="title" class="form-control shadow-sm" placeholder="Introdueix el títol" required value="{{ old('title') }}" data-qa="title-input">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Descripció</label>
                        <textarea name="description" id="description" rows="3" class="form-control shadow-sm" placeholder="Introdueix la descripció" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">Imatge</label>
                        <input type="text" name="image" id="image" class="form-control shadow-sm" placeholder="URL de la imatge" value="{{ old('image') }}" data-qa="image-input">
                    </div>

                    <div class="mb-4">
                        <label for="videos" class="form-label">Assigna Vídeos Existents</label>
                        <select name="videos[]" id="videos" class="form-select shadow-sm" multiple>
                            @foreach($videos as $video)
                                <option value="{{ $video->id }}"
                                    {{ in_array($video->id, old('videos', [])) ? 'selected' : '' }}>
                                    {{ $video->title }} ({{ $video->published_at->format('Y-m-d') }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Mantingues premut Ctrl (Windows) o Cmd (Mac) per seleccionar múltiples vídeos</small>
                    </div>

                    <button type="submit" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold; border-radius: 5px; padding: 10px 20px;" data-qa="submit-create-btn">Crear Sèrie</button>
                </div>
            </div>
        </form>
    </div>
</x-videos-app-layout>
