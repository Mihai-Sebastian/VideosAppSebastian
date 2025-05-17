<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Editar Sèrie: {{ $serie->title }}</h1>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Formulari d'Edició</h5>
                    </div>

                    <div class="card-body-custom">
                        <form action="{{ route('series.manage.update', $serie->id) }}" method="POST" data-qa="edit-series-form">
                            @csrf
                            @method('PUT')

                            <!-- Títol -->
                            <div class="mb-4">
                                <label for="title" class="form-label">Títol</label>
                                <input type="text"
                                       name="title"
                                       id="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Introdueix el títol"
                                       value="{{ old('title', $serie->title) }}"
                                       required
                                       data-qa="title-input">
                                @error('title')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Descripció -->
                            <div class="mb-4">
                                <label for="description" class="form-label">Descripció</label>
                                <textarea name="description"
                                          id="description"
                                          rows="3"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Introdueix la descripció"
                                          data-qa="description-input">{{ old('description', $serie->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Imatge -->
                            <div class="mb-4">
                                <label for="image" class="form-label">URL de la Imatge</label>
                                <input type="text"
                                       name="image"
                                       id="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       placeholder="URL de la imatge"
                                       value="{{ old('image', $serie->image) }}"
                                       data-qa="image-input">
                                @error('image')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Vídeos assignats -->
                            <div class="mb-4">
                                <label for="videos" class="form-label">Assigna vídeos a la sèrie</label>
                                <select name="videos[]" id="videos" class="form-select" multiple data-qa="videos-select">
                                    @foreach($videos as $video)
                                        <option value="{{ $video->id }}"
                                            {{ in_array($video->id, $selectedVideos) ? 'selected' : '' }}>
                                            {{ $video->title }} ({{ $video->published_at->format('Y-m-d') }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Mantingues premut Ctrl (Windows) o Cmd (Mac) per seleccionar múltiples vídeos.</small>
                            </div>

                            <!-- Botó Actualitzar -->
                            <div class="text-center mt-5">
                                <button type="submit"
                                        class="btn-primary-custom"
                                        data-qa="submit-edit-btn">
                                    <i class="fas fa-save me-2"></i>Actualitzar Sèrie
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
