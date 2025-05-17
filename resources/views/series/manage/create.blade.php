<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Crear Nova Sèrie</h1>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Formulari de Creació
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('series.manage.store') }}" method="POST" data-qa="create-series-form">
                            @csrf

                            <!-- Títol -->
                            <div class="mb-4">
                                <label for="title" class="form-label">Títol</label>
                                <input type="text"
                                       name="title"
                                       id="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Introdueix el títol"
                                       required
                                       value="{{ old('title') }}"
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
                                          required
                                          data-qa="description-input">{{ old('description') }}</textarea>
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
                                       value="{{ old('image') }}"
                                       data-qa="image-input">
                                @error('image')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Assignació de vídeos -->
                            <div class="mb-4">
                                <label for="videos" class="form-label">Assigna Vídeos Existents</label>
                                <select name="videos[]" id="videos" class="form-select" multiple data-qa="videos-select">
                                    @foreach($videos as $video)
                                        <option value="{{ $video->id }}"
                                            {{ in_array($video->id, old('videos', [])) ? 'selected' : '' }}>
                                            {{ $video->title }} ({{ $video->published_at->format('Y-m-d') }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Mantingues premut Ctrl (Windows) o Cmd (Mac) per seleccionar múltiples vídeos.</small>
                            </div>

                            <!-- Botó Crear -->
                            <div class="text-center mt-5">
                                <button type="submit"
                                        class="btn-primary-custom"
                                        data-qa="submit-create-btn">
                                    <i class="fas fa-check me-2"></i>Crear Sèrie
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
