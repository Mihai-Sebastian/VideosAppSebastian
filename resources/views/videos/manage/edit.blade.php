<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Editar Vídeo</h1>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Formulari d'Edició
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="title" class="form-label">Títol</label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="title"
                                       name="title"
                                       value="{{ old('title', $video->title) }}"
                                       data-qa="video-title"
                                       required>
                                @error('title')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Descripció</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="4"
                                          data-qa="video-description"
                                          required>{{ old('description', $video->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="url" class="form-label">URL del Vídeo</label>
                                <input type="url"
                                       class="form-control @error('url') is-invalid @enderror"
                                       id="url"
                                       name="url"
                                       value="{{ old('url', $video->url) }}"
                                       data-qa="video-url"
                                       required>
                                @error('url')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn-primary-custom" data-qa="update-video-btn">
                                    <i class="fas fa-save me-2"></i>Actualitzar Vídeo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
