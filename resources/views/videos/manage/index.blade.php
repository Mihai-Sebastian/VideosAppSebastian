<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestió de Vídeos</h1>

        <!-- Botó Afegir Vídeo -->
        <div class="d-flex justify-content-center mb-4">
            <a href="{{ route('videos.manage.create') }}"
               class="btn-primary-custom text-uppercase"
               style="border-radius: 25px;"
               data-qa="create-video-btn">
                <i class="fas fa-plus me-2"></i>Afegir Vídeo
            </a>
        </div>

        <!-- Taula de Vídeos -->
        <div class="custom-card p-4">
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
                                    <!-- Botó Editar -->
                                    <a href="{{ route('videos.manage.edit', $video->id) }}"
                                       class="btn btn-warning-custom btn-sm"
                                       data-qa="edit-video-{{ $video->id }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>

                                    <!-- Botó Eliminar (redirecció a vista de confirmació) -->
                                    <a href="{{ route('videos.manage.delete', $video->id) }}"
                                       class="btn btn-danger-custom btn-sm"
                                       data-qa="delete-video-{{ $video->id }}">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </a>
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
    </div>
</x-videos-app-layout>
