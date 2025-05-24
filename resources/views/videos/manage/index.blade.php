<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestió de Vídeos</h1>

        <!-- Botó Afegir Vídeo -->
        <div class="d-flex justify-content-center mb-4">
            <x-button color="primary" href="{{ route('videos.manage.create') }}">
                <i class="fas fa-plus me-2"></i>Afegir Vídeo
            </x-button>

        </div>

        <!-- TAULA per a escriptori -->
        <div class="custom-card p-4 d-none d-md-block">
            <div class="table-responsive">
                <table class="table table-hover text-center w-100" style="min-width: 600px;">
                    <thead style="background: linear-gradient(45deg, var(--primary-color), var(--primary-hover)); color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Títol</th>
                        <th>Descripció</th>
                        <th>Accions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($videos as $video)
                        <tr style="background-color: var(--card-bg); color: var(--text-primary); height: 60px;">
                            <td>{{ $video->id }}</td>
                            <td>{{ $video->title }}</td>
                            <td class="text-start">{{ Str::limit($video->description, 80) }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <x-button color="warning" href="{{ route('videos.manage.edit', $video->id) }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </x-button>

                                    <x-button color="danger" href="{{ route('videos.manage.delete', $video->id) }}">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </x-button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hi ha vídeos disponibles.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LLISTA per a mòbil -->
        <div class="d-block d-md-none">
            @forelse($videos as $video)
                <div class="custom-card mb-3">
                    <div class="card-body-custom">
                        <h5 class="mb-2"><i class="fas fa-play-circle me-2"></i>{{ $video->title }}</h5>
                        <p class="mb-1"><strong>ID:</strong> {{ $video->id }}</p>
                        <p class="mb-2"><strong>Descripció:</strong> {{ Str::limit($video->description, 100) }}</p>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('videos.manage.edit', $video->id) }}"
                               class="btn btn-warning-custom btn-sm"
                               data-qa="edit-video-mobile-{{ $video->id }}">
                                <i class="fas fa-edit me-1"></i>Editar
                            </a>
                            <a href="{{ route('videos.manage.delete', $video->id) }}"
                               class="btn btn-danger-custom btn-sm"
                               data-qa="delete-video-mobile-{{ $video->id }}">
                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted my-4">
                    <i class="fas fa-info-circle me-2"></i>No hi ha vídeos disponibles.
                </div>
            @endforelse
        </div>

    </div>
</x-videos-app-layout>
